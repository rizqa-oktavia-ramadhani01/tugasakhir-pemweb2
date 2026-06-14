<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LearningContentController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\ParentJournalController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\EducationController;

// Admin Controllers
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

// ==================== ROUTE LOGOUT ====================

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [LogOutController::class, 'index'])->name('logout.confirm');

// ==================== ROUTE USER ====================

Route::middleware('auth')->group(function () {

    // Dashboard & Switch Child
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/switch-child/{id}', [DashboardController::class, 'switchChild'])->name('switch.child');

    // Toggle Activity (AJAX)
    Route::post('/toggle-activity', [DashboardController::class, 'toggleActivity'])->name('toggle-activity');

    // Parent Journal
    Route::resource('parent-journals', ParentJournalController::class);
    Route::get('parent-journals-report', [ParentJournalController::class, 'report'])->name('parent-journals.report');

    // Progress
    Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
    Route::post('/toggle-milestone', [ProgressController::class, 'toggleMilestone'])->name('toggle-milestone');

    // Resources
    Route::resource('children', ChildController::class);
    Route::get('/activities', [DashboardController::class, 'activities'])->name('activities.index');
    // Route::resource('activities', ActivityController::class);

    // Area Anak Mandiri (Bermain)
    Route::get('/area-anak/latih-pelafalan', [LearningContentController::class, 'pelafalan'])
        ->name('learning-contents.pelafalan');

    // ROUTE BARU: Tantangan Bahasa
    Route::get('/area-anak/tantangan-bahasa', [LearningContentController::class, 'tantangan'])
        ->name('learning-contents.tantangan');

    Route::resource('learning-contents', LearningContentController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/name', [ProfileController::class, 'updateName'])->name('profile.update-name');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting/password', [SettingController::class, 'updatePassword'])->name('setting.update-password');
    Route::post('/setting/reset-data', [SettingController::class, 'resetData'])->name('setting.reset-data');

});

// Education
Route::get('/education', [EducationController::class, 'index'])
    ->name('education.index');

Route::get('/education/{id}', [EducationController::class, 'show'])
    ->name('education.show');

// ==================== ROUTE KHUSUS ADMIN ====================

Route::prefix('admin')->middleware('auth')->group(function () {

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
    Route::get('/activities/{id}/show', [AdminActivityController::class, 'show'])->name('admin.activities.show');
    Route::get('/activities/{id}/edit', [AdminActivityController::class, 'edit'])->name('admin.activities.edit');
    Route::put('/activities/{id}', [AdminActivityController::class, 'update'])->name('admin.activities.update');
    Route::delete('/activities/{id}', [AdminActivityController::class, 'destroy'])->name('admin.activities.destroy');

    // Learning Contents CRUD
    Route::get('/learning-contents', [AdminLearningContentController::class, 'index'])->name('admin.learning-contents.index');
    Route::get('/learning-contents/create', [AdminLearningContentController::class, 'create'])->name('admin.learning-contents.create');
    Route::post('/learning-contents', [AdminLearningContentController::class, 'store'])->name('admin.learning-contents.store');
    Route::get('/learning-contents/{id}/show', [AdminLearningContentController::class, 'show'])->name('admin.learning-contents.show');
    Route::get('/learning-contents/{id}/edit', [AdminLearningContentController::class, 'edit'])->name('admin.learning-contents.edit');
    Route::put('/learning-contents/{id}', [AdminLearningContentController::class, 'update'])->name('admin.learning-contents.update');
    Route::delete('/learning-contents/{id}', [AdminLearningContentController::class, 'destroy'])->name('admin.learning-contents.destroy');
});
