<?php

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Auth\Admin\AdminAuthentication;
use App\Http\Controllers\Auth\User\UserAuthentication;
use App\Http\Controllers\User\UserGuide;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Authentication Admin
Route::get('/login', [AdminAuthentication::class, 'index'])->name('login');
Route::post('/login', [AdminAuthentication::class, 'login']);

Route::get('/register', [AdminAuthentication::class, 'create'])->name('register');
Route::post('/register', [AdminAuthentication::class, 'store']);

Route::post('/logout', [AdminAuthentication::class, 'logout'])->name('logout');

// Authentication User
Route::get('/', [UserAuthentication::class, 'index'])->name('home');

// Admin
Route::middleware([AdminMiddleware::class])->group(function() {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    Route::get('/settings', [Settings::class, 'index'])->name('setting');

    Route::post('/dashboard', [Dashboard::class, 'create']);

    // Get Schema Data
    Route::get('/get/schema/{id}', [Dashboard::class, 'getSchema']);
});

// User
Route::get('/user-guide', [UserGuide::class, 'index']);