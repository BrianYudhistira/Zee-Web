<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardsController\PortfolioController;
use App\Http\Controllers\DashboardsController\ProfileController;
use App\Http\Controllers\DashboardsController\ProjectController;
use App\Http\Controllers\DashboardsController\SkillController;

use App\Http\Controllers\WebController;
use App\Http\Middleware\CheckLogin;

Route::get('/', [WebController::class, 'index']);

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

Route::get('/login', [WebController::class, 'login']);
Route::post('/login', [WebController::class, 'signin'])->name('signin');

Route::get('/register', [WebController::class, 'register']);
Route::post('/register', [WebController::class, 'signup'])->name('signup');

Route::post('/logout', function (Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/menu')->with('success', 'Logout successful!');
})->name('logout');


Route::prefix('dashboard')->group(function () {
    Route::prefix('/profile')->group(function(){
        Route::get('/index', [ProfileController::class, 'index'])->middleware(CheckLogin::class)->name('profile');
        Route::prefix('/manage')->group(function () {
            //Profile Routes
            Route::get('/profile_form', [ProfileController::class, 'profileForm'])->middleware(CheckLogin::class)->name('profile.form');
            Route::post('/profile_form/update', [ProfileController::class, 'storeProfile'])->middleware(CheckLogin::class)->name('profile.store');

            //Project Routes
            Route::get('/project_form/{project?}', [ProjectController::class, 'indexform'])->middleware(CheckLogin::class)->name('project.form');
            Route::post('/project_form/create', [ProjectController::class, 'storeProject'])->middleware(CheckLogin::class)->name('project.store');
            Route::put('/project_form/update/{project}', [ProjectController::class, 'updateProject'])->middleware(CheckLogin::class)->name('project.update');
            Route::delete('/project_form/delete/{project}', [ProjectController::class, 'destroyProject'])->middleware(CheckLogin::class)->name('project.destroy');

            //Skill Routes
            Route::get('/skills_form/{skill?}', [SkillController::class, 'indexform'])->middleware(CheckLogin::class)->name('skills.form');
            Route::post('/skills_form/create', [SkillController::class, 'storeSkill'])->middleware(CheckLogin::class)->name('skills.store');
            Route::put('/skills_form/update/{skill}', [SkillController::class, 'updateSkill'])->middleware(CheckLogin::class)->name('skills.update');
            Route::delete('/skills_form/delete/{skill}', [SkillController::class, 'destroySkill'])->middleware(CheckLogin::class)->name('skills.destroy');
        });
    });
    
    Route::get('/data_scraper', [WebController::class, 'data_scraper'])->middleware(CheckLogin::class);
    Route::get('/data_scraper/run', [App\Http\Controllers\ScraperController::class, 'scrapeSync'])->middleware(CheckLogin::class)->name('admin.scraper.run');
});

//ZeeScraper Route
Route::get('/ZeeScraper', function () {
    return view('zeescraper.scraper');
})->name('zeescraper');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');
