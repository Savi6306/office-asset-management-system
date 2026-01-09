<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\EmployeeController;



Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Assets Routes (CRUD)
Route::resource('assets', AssetController::class)
    ->middleware(['auth']);

// Categories Routes (CRUD)
Route::resource('categories', CategoryController::class)
    ->middleware(['auth']);

// Profile Routes (Breeze Default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Assignment Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/assign', [AssetController::class, 'showAssignForm'])->name('assets.assign.form');
    Route::post('/assets/{asset}/assign', [AssetController::class, 'assign'])->name('assets.assign');
    Route::post('/assets/{asset}/return', [AssetController::class, 'return'])->name('assets.return');
});
// Categories Routes
Route::resource('categories', CategoryController::class);
Route::get('categories/stats', [CategoryController::class, 'getCategoryStats'])
    ->name('categories.stats');
    // Asset assignment routes
Route::get('assets/assign', [AssetController::class, 'assign'])->name('assets.assign');
Route::post('assets/{asset}/assign', [AssetController::class, 'assignToUser'])->name('assets.assign.user');

// Category status toggle
Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');

// Filtered assets by category
Route::get('assets/category/{category}', [AssetController::class, 'byCategory'])->name('assets.by-category');

// Assignment Routes
    Route::resource('assignments', AssignmentController::class);
    Route::post('assignments/{assignment}/return', [AssignmentController::class, 'returnAsset'])
        ->name('assignments.return');
    Route::get('assignments/asset/{asset}', [AssignmentController::class, 'getAssetAssignments'])
        ->name('assignments.asset');
    Route::get('assignments/user/{user}', [AssignmentController::class, 'getUserAssignments'])
        ->name('assignments.user');

// Employee Management Routes
Route::resource('employees', EmployeeController::class);
Route::post('employees/{employee}/assign-asset', [EmployeeController::class, 'assignAsset'])->name('employees.assign-asset');
Route::post('employees/{employee}/return-asset/{asset}', [EmployeeController::class, 'returnAsset'])->name('employees.return-asset');
Route::middleware(['auth'])->group(function () {
    Route::resource('employees', EmployeeController::class);
});

require __DIR__.'/auth.php';


