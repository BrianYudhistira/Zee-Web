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
    
    public $timeout = 300;
    
    public $tries = 3;

    public $backoff = 60;

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
            set_time_limit(300); // 5 minutes
            
            $output = shell_exec($command);
            
            Log::info("Scraper completed successfully");
            Log::info("Scraper Output: " . $output);
            
            $user->notify(new ScraperCompleted($user->name, 'Completed'));
            
        } catch (\Exception $e) {
            Log::error("Scraper Error: " . $e->getMessage());
            $user->notify(new ScraperCompleted($user->name, 'Failed: ' . $e->getMessage()));
        }
    }
}
