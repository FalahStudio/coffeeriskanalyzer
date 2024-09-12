<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaitingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Ruang Tunggu',
        ];

        return view('pages.user.waiting.index', $data);
    }
}
