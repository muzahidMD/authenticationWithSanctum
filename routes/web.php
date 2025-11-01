<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/register', [RegisterController::class, 'show'])->name('register.show')->middleware(RedirectIfAuthenticated::class);
Route::get('/register', [RegisterController::class, 'show'])
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])
    ->name('register');

Route::get('/login', [LoginController::class, 'show'])
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])
    ->name('login');

Route::get('/dashboard', [DashboardController::class, 'show'])
    ->middleware('auth')
    ->name('dashboard');