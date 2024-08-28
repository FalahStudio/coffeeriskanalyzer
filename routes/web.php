<?php

use Illuminate\Support\Facades\Route;

// Default Routing
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('pages.testing');
});
