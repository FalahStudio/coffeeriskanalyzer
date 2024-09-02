<?php

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Auth\Admin\AdminAuthentication;
use App\Http\Controllers\Auth\User\UserAuthentication;
use App\Http\Controllers\User\UserGuide;
use Illuminate\Support\Facades\Route;

// Authentication Admin
Route::get('/admin/login', [AdminAuthentication::class, 'index']);
Route::get('/admin/register', [AdminAuthentication::class, 'create']);

// Authentication User
Route::get('/', [UserAuthentication::class, 'index'])->name('home');

// Admin
Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
Route::get('/settings', [Settings::class, 'index'])->name('setting');

// User
Route::get('/user-guide', [UserGuide::class, 'index']);