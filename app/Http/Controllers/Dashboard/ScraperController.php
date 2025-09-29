<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use App\Jobs\zzzScraperJob;
use App\Models\zzz_char;
use App\Models\zzz_diskdrive;
use App\Models\zzz_wengine;
use App\Http\Controllers\Controller;


class ScraperController extends Controller
{
    /**
     * Show the scraper admin page.
     */
    /**
     * Trigger the scraper job asynchronously.
     */
    public function index()
    {
        $user = Auth::user();
        // Get characters with pagination - ordered by ID ascending
        $zzzchar = zzz_char::with(['zzz_diskdrive', 'zzz_wengine'])
                          ->orderBy('id', 'asc')
                          ->paginate(10, ['*'], 'char_page');
        
        // Get disk drives with their related characters - ordered by character ID
        $zzzdiskdrive = zzz_diskdrive::with('zzzChar')
                                   ->orderBy('zzz_char_id', 'asc')
                                   ->paginate(10, ['*'], 'diskdrive_page');
        
        // Get W-engines with their related characters - ordered by character ID
        $zzzwengine = zzz_wengine::with('zzzChar')
                                ->orderBy('zzz_char_id', 'asc')
                                ->paginate(10, ['*'], 'wengine_page');
        
        return view('dashboard/data_scraper', compact('zzzchar', 'zzzdiskdrive', 'zzzwengine', 'user'));
    }

    public function scrapeNow()
    {
        $user = Auth::user();
        $cacheKey = "scraper_user_{$user->id}";
        $lastRun = cache()->get($cacheKey);

        
        if ($lastRun) {
            $timeLeft = 60 - (time() - $lastRun);
            if ($timeLeft > 0) {
                return redirect()->back()->with('error', "Please wait {$timeLeft} seconds before running scraper again.");
            }
        }
        cache()->put($cacheKey, time(), 60); 

        zzzScraperJob::dispatch($user->id);
        return redirect()->back()->with('status', 'Scraper job has been queued.');
    }

    /**
     * Trigger the scraper job synchronously.
     */
    public function scrapeSync()
    {
        (new zzzScraperJob(Auth::id()))->dispatchSync();
        return redirect()->back()->with('status', 'Scraper job has completed.');
    }
}