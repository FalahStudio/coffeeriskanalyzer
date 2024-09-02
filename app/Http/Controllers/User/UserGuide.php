<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserGuide extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'User Guide',
        ];

        return view('pages.user.userGuide.index', $data);
    }
}
