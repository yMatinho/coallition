<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AbleToLogin;
use App\Http\Middleware\IsLogged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('')
->middleware(IsLogged::class)
->name('site.')
->group(function () {

    Route::get('/', [SiteController::class, 'home'])->name('home');

    Route::prefix('tasks')->name('tasks.')->group(function() {
        Route::get('/tasks', [TaskController::class, 'list'])->name('list');
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('create');
        Route::post('/tasks/create', [TaskController::class, 'store'])->name('store');
        Route::get('/tasks/edit/{reference}', [TaskController::class, 'edit'])->name('edit');
        Route::post('/tasks/edit/', [TaskController::class, 'update'])->name('update');
        Route::get('/tasks/delete/{reference}', [TaskController::class, 'delete'])->name('delete');
        Route::get('/tasks/reorder', [TaskController::class, 'reorder'])->name('reorder');
    });

    Route::prefix('projects')->name('projects.')->group(function() {
        Route::get('/projects', [ProjectController::class, 'list'])->name('list');
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/projects/create', [ProjectController::class, 'store'])->name('store');
        Route::get('/projects/edit/{reference}', [ProjectController::class, 'edit'])->name('edit');
        Route::post('/projects/edit/', [ProjectController::class, 'update'])->name('update');
        Route::get('/projects/delete/{reference}', [ProjectController::class, 'delete'])->name('delete');
    });

});

Route::prefix('login')->name('login.')->group(function() {
    Route::get('/login', [LoginController::class, 'show'])
    ->middleware(AbleToLogin::class)
    ->name('show');

    Route::post('/login', [LoginController::class, 'login'])
    ->name('login')
    ->middleware(AbleToLogin::class);

    Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware(IsLogged::class);
});
