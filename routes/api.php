<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\DirectoryApiController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Public Directory Routes
Route::prefix('directory')->controller(DirectoryApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('{id}', 'show');
});

// Public List Routes for Registration & Filtering
Route::get('villages', [VillageController::class, 'index']);
Route::get('professions', [ProfessionController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->middleware('isAdmin');
        Route::get('profile', 'profile');
        Route::put('profile', 'update');
        Route::get('search/{keyword}', 'search')->middleware('isAdmin');
        Route::post('/', 'store')->middleware('isAdmin');
        Route::get('{user}', 'show')->middleware('isAdmin');
        Route::put('{user}', 'updateUser')->middleware('isAdmin');
        Route::delete('{user}', 'destroy')->middleware('isAdmin');
    });

    Route::prefix('villages')->controller(VillageController::class)->group(function () {
        Route::get('{village}/users', 'users_in_village');
        Route::post('/', 'store')->middleware('isAdmin');
        Route::put('{village}', 'update')->middleware('isAdmin');
        Route::delete('{village}', 'destroy')->middleware('isAdmin');
    });

    Route::prefix('professions')->controller(ProfessionController::class)->group(function () {
        Route::get('{profession}/users', 'users_in_profession');
        Route::post('/', 'store')->middleware('isAdmin');
        Route::put('{profession}', 'update')->middleware('isAdmin');
        Route::delete('{profession}', 'destroy')->middleware('isAdmin');
    });
});
