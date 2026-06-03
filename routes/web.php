<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LearningContentController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogOutController;
use Illuminate\Support\Facades\Auth;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\LearningContentController as AdminLearningContentController;

// ==================== ROUTE TANPA AUTH ====================
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

// ==================== ROUTE LOGOUT ====================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [LogOutController::class, 'index'])->name('logout.confirm');

// ==================== ROUTE DASHBOARD ====================
Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// ==================== ROUTE UNTUK PARENT (USER BIASA) ====================
Route::middleware('auth')->group(function () {
    Route::resource('children', ChildController::class);
    Route::resource('activities', ActivityController::class);
    Route::resource('learning-contents', LearningContentController::class);
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/name', [ProfileController::class, 'updateName'])->name('profile.update-name');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting/password', [SettingController::class, 'updatePassword'])->name('setting.update-password');
    Route::post('/setting/reset-data', [SettingController::class, 'resetData'])->name('setting.reset-data');
});

// ==================== ROUTE KHUSUS ADMIN ====================
Route::prefix('admin')->middleware('auth')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak! Hanya untuk admin.');
        }
        $totalParents = \App\Models\User::where('role', 'parent')->count();
        $totalActivities = \App\Models\Activity::count();
        $totalContents = \App\Models\LearningContent::count();
        return view('admin.dashboard', compact('totalParents', 'totalActivities', 'totalContents'));
    })->name('admin.dashboard');
    
    // Activities CRUD
    Route::get('/activities', [AdminActivityController::class, 'index'])->name('admin.activities.index');
    Route::get('/activities/create', [AdminActivityController::class, 'create'])->name('admin.activities.create');
    Route::post('/activities', [AdminActivityController::class, 'store'])->name('admin.activities.store');
    Route::get('/activities/{id}/show', [AdminActivityController::class, 'show'])->name('admin.activities.show'); // ← TAMBAHKAN INI
    Route::get('/activities/{id}/edit', [AdminActivityController::class, 'edit'])->name('admin.activities.edit');
    Route::put('/activities/{id}', [AdminActivityController::class, 'update'])->name('admin.activities.update');
    Route::delete('/activities/{id}', [AdminActivityController::class, 'destroy'])->name('admin.activities.destroy');
    
    // Learning Contents CRUD
    Route::get('/learning-contents', [AdminLearningContentController::class, 'index'])->name('admin.learning-contents.index');
    Route::get('/learning-contents/create', [AdminLearningContentController::class, 'create'])->name('admin.learning-contents.create');
    Route::post('/learning-contents', [AdminLearningContentController::class, 'store'])->name('admin.learning-contents.store');
    Route::get('/learning-contents/{id}/show', [AdminLearningContentController::class, 'show'])->name('admin.learning-contents.show'); // ← TAMBAHKAN INI
    Route::get('/learning-contents/{id}/edit', [AdminLearningContentController::class, 'edit'])->name('admin.learning-contents.edit');
    Route::put('/learning-contents/{id}', [AdminLearningContentController::class, 'update'])->name('admin.learning-contents.update');
    Route::delete('/learning-contents/{id}', [AdminLearningContentController::class, 'destroy'])->name('admin.learning-contents.destroy');
});