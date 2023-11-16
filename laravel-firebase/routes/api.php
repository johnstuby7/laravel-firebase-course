<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DatabaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::put('user',[AuthController::class,'update']);

Route::post('disable',[AuthController::class,'disable']);
Route::post('enable',[AuthController::class,'enable']);

// All Users
Route::get('users',[AuthController::class,'index']);

// Single User
Route::get('user',[AuthController::class,'show']);

// Delete User
Route::delete('user',[AuthController::class,'delete']);

Route::prefix('real-db')->group(function() {
    Route::post('/',[DatabaseController::class, 'store']);
    Route::get('/',[DatabaseController::class, 'index']);
    Route::put('/',[DatabaseController::class, 'update']);
});