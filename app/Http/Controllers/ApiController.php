<?php

namespace App\Http\Controllers;

use App\Models\zzz_char;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(): JsonResponse
    {
        $character = zzz_char::with(['zzz_diskdrive', 'zzz_wengine', 'zzz_bestdiskdrivestat'])->get();
        return response()->json(['message' => $character]);
    }
    
    public function store(Request $request): JsonResponse
    {
        $character = zzz_char::create($request->all());
        return response()->json(['message' => 'Character created successfully', 'data' => $character], 201);
    }

    
}