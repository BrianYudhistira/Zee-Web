<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WebController;
use App\Http\Middleware\CheckLogin;

Route::get('/', [WebController::class, 'index']);

Route::get('/portfolio', [App\Http\Controllers\PortfolioController::class, 'index'])->name('portfolio');

Route::get('/login', [WebController::class, 'login']);
Route::post('/login', [WebController::class, 'signin'])->name('signin');

Route::get('/register', [WebController::class, 'register']);
Route::post('/register', [WebController::class, 'signup'])->name('signup');

Route::get('/data_scraper', [WebController::class, 'dashboard'])->middleware(CheckLogin::class);

//Profile Update Form
Route::get('/profile_form', [PortfolioController::class, 'profileForm'])->middleware(CheckLogin::class)->name('profile.form');

Route::get('/profile', [PortfolioController::class, 'profile'])->middleware(CheckLogin::class)->name('profile');

Route::get('/project_form/{project?}', [PortfolioController::class, 'project_form'])->middleware(CheckLogin::class)->name('project.form');
Route::get('/skills_form/{skill?}', [PortfolioController::class, 'skills_form'])->middleware(CheckLogin::class)->name('skills.form');

//Create
Route::post('/project_form/create', [PortfolioController::class, 'storeProject'])->middleware(CheckLogin::class)->name('project.store');
Route::post('/skills_form/create', [PortfolioController::class, 'storeSkill'])->middleware(CheckLogin::class)->name('skills.store');

//update
Route::post('/profile_form/update', [PortfolioController::class, 'storeProfile'])->middleware(CheckLogin::class)->name('profile.store');
Route::put('/project_form/update/{project}', [PortfolioController::class, 'updateProject'])->middleware(CheckLogin::class)->name('project.update');
Route::put('/skills_form/update/{skill}', [PortfolioController::class, 'updateSkill'])->middleware(CheckLogin::class)->name('skills.update');

//Delete
Route::delete('/project_form/delete/{project}', [PortfolioController::class, 'destroyProject'])->middleware(CheckLogin::class)->name('project.destroy');
Route::delete('/skills_form/delete/{skill}', [PortfolioController::class, 'destroySkill'])->middleware(CheckLogin::class)->name('skills.destroy');

Route::get('/ZeeScraper', function () {
    return view('zeescraper.scraper');
})->name('zeescraper');

Route::post('/logout', function (Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/menu')->with('success', 'Logout successful!');
})->name('logout');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');
