<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Attempter\AttempterDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Reviewer\ReviewerDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Admin Routes with `auth` middleware and `admin` prefix
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Add additional admin routes here...
});

// Reviewer Routes: Only accessible by users with role_id = 2 (Reviewer)
Route::middleware(['auth', 'reviewer'])->prefix('reviewer')->group(function () {
    Route::get('/dashboard', [ReviewerDashboardController::class, 'index'])->name('reviewer.tasks');
    // Add additional reviewer routes here...
});

// Tasker Routes: Only accessible by users with role_id = 3 (Tasker/Attempter)
Route::middleware(['auth', 'attempter'])->prefix('attempter')->group(function () {
    Route::get('/dashboard', [AttempterDashboardController::class, 'index'])->name('tasker.dashboard');
    // Add additional tasker routes here...
});
require __DIR__.'/auth.php';
