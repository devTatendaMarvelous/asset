<?php

use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssetLogController;



Route::get('/', function () {
    return redirect()->route('home');
});
Route::resource('categories', CategoryController::class);
Route::resource('gadgets', AssetController::class);
Route::resource('users', UsersController::class);
Route::resource('students', UsersController::class);
Route::resource('roles', RolesController::class);
Route::post('users/{user}/password', [UsersController::class, 'passwordChange'])->name('users.password');
Auth::routes();

Route::get('/assets/{asset}/download',[AssetController::class,'downloadQr'])->name('assets.qr.download');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
