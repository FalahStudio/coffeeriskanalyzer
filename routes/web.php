<?php

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Auth\Admin\AdminAuthentication;
use Illuminate\Support\Facades\Route;

// Authentication
Route::get('/login', [AdminAuthentication::class, 'index']);
Route::get('/register', [AdminAuthentication::class, 'create']);

// Admin
Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
Route::get('/settings', [Settings::class, 'index'])->name('setting');