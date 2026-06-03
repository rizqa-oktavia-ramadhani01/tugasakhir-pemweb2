<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LearningContentController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('splash');
});

Route::get('/auth', function () {
    return view('auth.auth');
})->name('auth');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('children', ChildController::class);

    Route::resource('activities', ActivityController::class);

    Route::resource('learning-contents', LearningContentController::class);
});