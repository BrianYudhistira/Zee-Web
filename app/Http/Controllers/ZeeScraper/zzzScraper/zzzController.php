<?php

namespace App\Http\Controllers\ZeeScraper\zzzScraper;

use App\Http\Controllers\Controller;
use App\Models\zzz_char;

class zzzController extends Controller
{
    //
    public function index()
    {
        $zzzChar = zzz_char::all();

        return view('zeescraper.zzzScraper.zzzscraper', compact('zzzChar'));
    }

    public function show($id)
    {
        $char = zzz_char::find($id);
        return view('zeescraper.zzzScraper.zzzdetail', compact('char'));
    }
}