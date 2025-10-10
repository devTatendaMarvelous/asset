<?php

use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth.mobile')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);


    Route::controller(AssetController::class)->group(function () {
        Route::get('assets/details', 'details');
        Route::post('assets/cloak', 'cloak');
    });

});
