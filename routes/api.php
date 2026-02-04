<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VillageController;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('users', [UserController::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('profile', 'profile');
        Route::get('show/{user}', 'show');
        Route::put('profile', 'update');
        Route::get('search/{keyword}', 'search');
        Route::delete('{user}', 'destroy')->middleware('isAdmin');
    });

    Route::get('villages', [VillageController::class, 'index']);
    Route::get('villages/{village}/users', [VillageController::class, 'users_in_village']);

    Route::get('professions', [ProfessionController::class, 'index']);
    Route::get('professions/{profession}/users', [ProfessionController::class, 'users_in_profession']);

    Route::post('logout', [AuthController::class, 'logout']);
});
