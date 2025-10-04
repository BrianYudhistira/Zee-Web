<?php

namespace App\Jobs;

use App\Models\zzz_scraper\zzz_char;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class imgScraperJob implements ShouldQueue
{
    use Queueable;
    
    public $tries = 3;

    public $backoff = 10; // bisa disesuaikan

    public $timeout = 300;


    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $char = zzz_char::with(['zzz_wengine', 'zzz_diskdrive'])->get();
        if (!$char) {
            Log::error("Character not found");
            return;
        }

        $dir = 'image/char_image';
        if (Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->deleteDirectory($dir);
            }
        Storage::disk('public')->makeDirectory($dir);

        $dir1 = 'image/wengine_image';
        if (Storage::disk('public')->exists($dir1)) {
                Storage::disk('public')->deleteDirectory($dir1);
            }
        Storage::disk('public')->makeDirectory($dir1);

        try{
            foreach($char as $char){
                if(!$char->image){
                    continue;
                }

                $response_char = Http::timeout(10)->withOptions(['verify' => false])->get($char->image);
                if ($response_char->successful()) {
                    $content = $response_char->body();

                    $cleanName = Str::slug($char->name, '_');

                    $filename = 'image/char_image/' . $cleanName . '_image.' . now()->timestamp . '.' . pathinfo($char->image, PATHINFO_EXTENSION);
                    Storage::disk('public')->put($filename, $content);
                    $char->image = 'storage/' . $filename;
                    $char->save();
                    Log::info("Image saved for character: " . $char->name);
                } else {
                    Log::error("Image Scraper Error: " . $response_char->body());
                }

                if ($char->zzz_wengine->isEmpty()) {
                        continue;
                    }

                foreach($char->zzz_wengine as $wengine) {
                    $response_wengine = Http::timeout(10)->withOptions(['verify' => false])->get($wengine->w_engine_picture);
                    if ($response_wengine->successful()) {
                        $content = $response_wengine->body();

                        $cleanName = Str::slug($wengine->build_name, '_');

                        $filename1 = 'image/wengine_image/' . $cleanName . '_image' . '.' . pathinfo($wengine->w_engine_picture, PATHINFO_EXTENSION);
                        Storage::disk('public')->put($filename1, $content);

                        $wengine->w_engine_picture = 'storage/' . $filename1;
                        $wengine->save();
                        Log::info("Image saved for weapon engine: " . $char->name);
                        
                    } else {
                        Log::error("W-Engine Scraper Error: " . $response_wengine->body());
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error("Image Scraper Error: " . $e->getMessage());
        }
    }
}