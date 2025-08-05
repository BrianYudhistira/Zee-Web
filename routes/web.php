<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WebController;
use App\Http\Middleware\CheckLogin;

Route::get('/', [WebController::class, 'index']);

Route::get('/portfolio', [WebController::class, 'portfolio']);

Route::get('/login', [WebController::class, 'login']);
Route::post('/login', [WebController::class, 'signin'])->name('signin');

Route::get('/register', [WebController::class, 'register']);
Route::post('/register', [WebController::class, 'signup'])->name('signup');

Route::get('/dashboard', [WebController::class, 'dashboard'])->middleware(CheckLogin::class);
Route::get('/profile', [WebController::class, 'profile'])->middleware(CheckLogin::class);

Route::post('/logout', function (Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/menu')->with('success', 'Logout successful!');
})->name('logout');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');