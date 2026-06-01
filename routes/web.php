<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LearningContentController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LogOutController;

Route::get('/', function () {
    return view('splash');
});

Route::get('/auth', function () {
    return view('auth.auth');
})->name('auth');

Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/logout', [LogOutController::class, 'index'])->name('logout.confirm');

Route::get('/setting', function () {
    return view('setting'); // Ubah ke view dashboard nanti
})->middleware('auth')->name('setting');

Route::resource('activities', ActivityController::class);
Route::resource('learning-contents', LearningContentController::class);
Route::middleware('auth')->group(function () {
    Route::resource('children', ChildController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('children', ChildController::class);
    Route::get('/setting', [SettingController::class, 'index'])->name('setting');
});