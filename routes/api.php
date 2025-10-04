<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Middleware\CheckApiToken;

// Public routes (no token required)
Route::get('/characters', [ApiController::class, 'index']);
Route::get('/characters/{id}', [ApiController::class, 'show']);

// Protected routes (require API token)
Route::middleware(CheckApiToken::class)->group(function () {
    Route::post('/store-character', [ApiController::class, 'store']);
});

