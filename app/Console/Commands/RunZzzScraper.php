<?php

namespace App\Console\Commands;

use App\Jobs\zzzScraperJob;
use Illuminate\Console\Command;

class RunZzzScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:run-zzz 
                            {--sync : Run synchronously instead of queuing}
                            {--queue=default : The queue to dispatch the job to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run ZZZ scraper job';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting ZZZ Scraper...');

        if ($this->option('sync')) {
            // Run synchronously
            $this->info('⚡ Running synchronously...');
            try {
                zzzScraperJob::dispatchSync();
                $this->info('✅ Scraper completed successfully!');
            } catch (\Exception $e) {
                $this->error('❌ Scraper failed: ' . $e->getMessage());
                return 1;
            }
        } else {
            // Queue the job
            $queue = $this->option('queue');
            $job = zzzScraperJob::dispatch()->onQueue($queue);
            
            $this->info("📋 Job queued successfully on '{$queue}' queue");
            $this->comment('💡 Use "php artisan queue:work" to process the job');
            $this->comment('📄 Check logs: storage/logs/laravel.log');
        }

        return 0;
    }
}
