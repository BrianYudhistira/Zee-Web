<?php

namespace App\Http\Controllers;

use App\Models\zzz_char;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['message' => zzz_char::all()]);
    }

    
}