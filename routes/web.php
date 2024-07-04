<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\POSController;

Route::resource('items', ItemController::class);


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('items', ItemController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
    Route::post('/pos/sale', [POSController::class, 'processSale'])->name('pos.sale');
});

