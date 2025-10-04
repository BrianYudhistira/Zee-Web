<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ScraperCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class zzzScraperJob implements ShouldQueue
{
    use Queueable;
    
    public $tries = 3;

    public $backoff = 10; // bisa disesuaikan

    public $timeout = 600; // 10 menit


    private $userid;
    /**
     * Create a new job instance.
     */
    public function __construct($userId)
    {
        $this->userid = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::find($this->userid);
        if(!$user){
            Log::error("User not found with ID: " . $this->userid);
            return;
        }

        try{
            Log::info("Starting scraper for user: " . $user->name);
            
            $command = "python3 " . resource_path('script/zzz_scraper.py') . " 2>&1";
            
            $output = shell_exec($command);
            
            // Check for error messages in output
            if (empty($output)) {
                throw new \Exception("Python script returned empty output");
            }
            
            if (stripos($output, '[ERROR]') !== false || 
                stripos($output, 'error') !== false || 
                stripos($output, 'exception') !== false ||
                stripos($output, 'traceback') !== false) {
                throw new \Exception("Python script error detected: " . $output);
            }
            
            Log::info("Scraper completed successfully");
            Log::info("Scraper Output: " . $output);
            
            $user->notify(new ScraperCompleted($user->name, 'Completed'));
            imgScraperJob::dispatch()->onQueue('image_scraper');
            
        } catch (\Exception $e) {
            Log::error("Scraper Error: " . $e->getMessage());
            $user->notify(new ScraperCompleted($user->name, 'Failed: ' . $e->getMessage()));
            throw $e;
        }
    }
}
