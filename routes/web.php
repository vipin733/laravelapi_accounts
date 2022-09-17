<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AdminController::class, 'home']);
Route::post('/login', [AdminController::class, 'login']);

 //admin routes 
Route::middleware(['auth','admin'])->group(function () {
    Route::view('/create/account', "create");
    Route::post('/create/account', [AdminController::class, 'create']);
    Route::post('/logout', [AdminController::class, 'logout']);
});


