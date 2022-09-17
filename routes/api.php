<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    //routes for auth 
    Route::get('/user', [UserController::class, 'show']);
    Route::get('/accounts', [UserController::class, 'index']);
    Route::patch('/update/account', [UserController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
});