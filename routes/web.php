<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DimensionController;
use App\Http\Controllers\Admin\LanguageController as AdminLanguageController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Attempter\AttempterDashboardController;
use App\Http\Controllers\Attempter\TaskingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Reviewer\ReviewerDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Admin Routes with `auth` middleware and `admin` prefix
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('users', UsersController::class);
    Route::resource('dimensions', DimensionController::class);
    Route::resource('languages', AdminLanguageController::class);

    // tasks
    Route::get('tasks/create', [TaskController::class, 'create'])->name('admin.tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('admin.tasks.store');
    Route::get('/tasks/available', [TaskController::class, 'availableTasks'])->name('admin.tasks.available');
});

// Reviewer Routes: Only accessible by users with role_id = 2 (Reviewer)
Route::middleware(['auth', 'reviewer'])->prefix('reviewer')->group(function () {
    Route::get('/dashboard', [ReviewerDashboardController::class, 'index'])->name('reviewer.tasks');
});

// Tasker Routes: Only accessible by users with role_id = 3 (Attempter)
Route::middleware(['auth', 'attempter'])->prefix('attempter')->group(function () {
    Route::get('/dashboard', [AttempterDashboardController::class, 'index'])->name('attempter.dashboard');

    Route::get('/tasking/start', [TaskingController::class, 'start'])
    ->name('attempter.tasking.start');

});



Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Route for 404 errors.
Route::get('/error/404', function () {
    return response()->view('errors.error404', [], 404);
})->name('error.404');

// Route for 500 errors.
Route::get('/error/500', function () {
    return response()->view('errors.error500', [], 500);
})->name('error.500');

Route::get('/error/403', function () {
    return response()->view('errors.error403', [], 403);
})->name('error.403');

// Fallback route to catch any undefined URL and redirect to your custom 404 page.
Route::fallback(function () {
    return redirect()->route('error.404');
});
require __DIR__ . '/auth.php';
