<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// redirect home to register page
Route::get('/', function () {
    return redirect()->route('register');
});

// registration routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// login routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// dashboard (protected by cookie check inside controller)
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

