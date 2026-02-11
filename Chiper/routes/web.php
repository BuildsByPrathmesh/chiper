<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;


Route::get('/', [ChirpController::class, 'index']);

// Authentication routes
Route::get('/login', [Login::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [Login::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [Login::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Registration routes
Route::get('/register', fn() => view('auth.register'))
    ->middleware('guest')
    ->name('register');
 
Route::post('/register', Register::class)
    ->middleware('guest');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::post('/chirps', [ChirpController::class, 'store']);
    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit']);
    Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);
});