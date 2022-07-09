<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AbleToLogin;
use App\Http\Middleware\IsLogged;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('')
->middleware(IsLogged::class)
->name('site.')
->group(function () {

    Route::get('/', [SiteController::class, 'home'])->name('home');

    Route::prefix('tasks')->name('tasks.')->group(function() {
        Route::get('/', [TaskController::class, 'list'])->name('list');
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/create', [TaskController::class, 'store'])->name('store');
        Route::get('/edit/{reference}', [TaskController::class, 'edit'])->name('edit');
        Route::post('/edit', [TaskController::class, 'update'])->name('update');
        Route::get('/delete/{reference}', [TaskController::class, 'delete'])->name('delete');
        Route::post('/reorder', [TaskController::class, 'reorder'])->name('reorder')->withoutMiddleware(VerifyCsrfToken::class);

        Route::post('change-project', [TaskController::class, 'changeProject'])->name('changeProject')->withoutMiddleware(VerifyCsrfToken::class);
    });

    Route::prefix('projects')->name('projects.')->group(function() {
        Route::get('/', [ProjectController::class, 'list'])->name('list');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/create', [ProjectController::class, 'store'])->name('store');
        Route::get('/edit/{reference}', [ProjectController::class, 'edit'])->name('edit');
        Route::post('/edit', [ProjectController::class, 'update'])->name('update');
        Route::get('/delete/{reference}', [ProjectController::class, 'delete'])->name('delete');
    });

});

Route::prefix('login')->name('login.')->group(function() {
    Route::get('/', [LoginController::class, 'show'])
    ->middleware(AbleToLogin::class)
    ->name('show');

    Route::post('/login', [LoginController::class, 'login'])
    ->name('login')
    ->middleware(AbleToLogin::class);

    Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware(IsLogged::class);
});
