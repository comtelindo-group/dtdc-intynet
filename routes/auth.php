<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'createAccount');
        Route::post('/login', 'store');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
