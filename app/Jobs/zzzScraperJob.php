<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class zzzScraperJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $command = "python3 " . resource_path('script/zzz_scraper.py') . " 2>&1";
        $output = shell_exec($command);
        Log::info("Scraper Output: " . $output);
        Log::info("Scraper Command: " . $command);
    }
}
