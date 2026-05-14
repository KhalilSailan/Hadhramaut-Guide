<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DirectoryController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\VillageController;
use App\Http\Controllers\Web\ProfessionController;
use App\Http\Middleware\checkuser;

Route::get('/', function () {
    return redirect('/directory');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendForgotPasswordLink'])->name('password.email');
    Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/settings', [DirectoryController::class, 'settings'])->name('settings.profile');
    Route::post('/settings', [DirectoryController::class, 'updateSettings'])->name('settings.update');
});

// General User Routes (Publicly accessible directory based on your previous code)
Route::get('/directory', [DirectoryController::class, 'index'])->name('directory.index');
Route::get('/directory/{id}', [DirectoryController::class, 'show'])->name('directory.show');


// Admin Routes
Route::middleware(['auth', checkuser::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    // Users Management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/users/{id}', [AdminController::class, 'showUser'])->name('users.show');
    Route::get('/numbers', [AdminController::class, 'numbers'])->name('numbers');

    // Villages Management
    Route::get('/villages', [VillageController::class, 'index'])->name('villages.index');
    Route::post('/villages', [VillageController::class, 'store'])->name('villages.store');
    Route::put('/villages/{id}', [VillageController::class, 'update'])->name('villages.update');
    Route::delete('/villages/{id}', [VillageController::class, 'destroy'])->name('villages.destroy');

    // Professions Management
    Route::get('/professions', [ProfessionController::class, 'index'])->name('professions.index');
    Route::post('/professions', [ProfessionController::class, 'store'])->name('professions.store');
    Route::put('/professions/{id}', [ProfessionController::class, 'update'])->name('professions.update');
    Route::delete('/professions/{id}', [ProfessionController::class, 'destroy'])->name('professions.destroy');
});
