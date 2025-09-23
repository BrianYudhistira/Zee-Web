<?php

namespace App\Http\Controllers;

use App\Jobs\zzzScraperJob;
class ScraperController extends Controller
{
    /**
     * Show the scraper admin page.
     */
    public function index()
    {
        return view('admin.scraper');
    }

    /**
     * Trigger the scraper job asynchronously.
     */
    public function scrapeNow()
    {
        zzzScraperJob::dispatch();
        return redirect()->back()->with('status', 'Scraper job has been queued.');
    }

    /**
     * Trigger the scraper job synchronously.
     */
    public function scrapeSync()
    {
        (new zzzScraperJob())->dispatchSync();
        return redirect()->back()->with('status', 'Scraper job has completed.');
    }
}