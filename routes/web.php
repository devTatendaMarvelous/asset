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

Route::middleware('auth')->group(function () {

Route::resource('categories', CategoryController::class);
Route::resource('gadgets', AssetController::class);
Route::resource('users', UsersController::class);
Route::resource('students', UsersController::class);
Route::resource('roles', RolesController::class);
Route::post('users/{user}/password', [UsersController::class, 'passwordChange'])->name('users.password');


Route::controller(AssetController::class)->group(function () {
    Route::get('/assets/{id}/download',[AssetController::class,'downloadQr'])->name('assets.qr.download');
Route::get('/assets/{id}/deregister',[AssetController::class,'deregister'])->name('assets.deregister');
    Route::post('/assets/{id}/blacklist',[AssetController::class,'blacklist'])->name('assets.blacklist');

});
    Route::controller(RolesController::class)->group(function (){
        Route::get('/roles','index')->name('roles.index');
        Route::get('/roles/create','create')->name('roles.create');
        Route::post('/roles/store','store')->name('roles.store');
        Route::get('/roles/{id}/edit','edit')->name('roles.edit');
        Route::get('/roles/{id}','show')->name('roles.show');
        Route::post('/roles/{id}/update','update')->name('roles.update');
        Route::get('/roles/{id}/delete','destroy')->name('roles.delete');
    });

});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
