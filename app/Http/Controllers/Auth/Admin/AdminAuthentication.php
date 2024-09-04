<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminAuthentication extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Sign In',
        ];

        return view('pages.auth.admin.login.index', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate(
                [
                    'email'                 => 'required|email:rfc,dns',
                    'password'              => 'required|min:8|max:20|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).*$/',
                ],
                [
                    'email.required'                => 'Email harus diisi.',
                    'email.email'                   => 'Format email tidak valid.',
                    'password.required'             => 'Password harus diisi.',
                    'password.min'                  => 'Password harus memiliki minimal 8 karakter.',
                    'password.max'                  => 'Password tidak boleh lebih dari 20 karakter.',
                    'password.regex'                => 'Password harus mengandung setidaknya satu huruf besar, satu angka, dan satu simbol',
                ]
            );

            if ($validated) {
                try {
                    $credentials = [
                        'email'     => $request->email,
                        'password'  => $request->password,
                    ];

                    if (Auth::attempt($credentials)) {
                        $flash = [
                            'title' => 'Berhasil',
                            'desc'  => 'Berhasil login, Selamat datang di halaman admin ' . config('app.name'),
                        ];

                        return redirect(route('dashboard'))->with('success' , $flash);
                    } else {
                         $flash = [
                            'title' => 'Gagal',
                            'desc'  => 'User tidak ditemukan, atau password salah!'
                        ];

                        return redirect()->back()->with('error' , $flash);
                    }
                } catch (Exception $e) {
                    $flash = [
                        'title' => 'Terjadi kesalahan',
                        'desc'  => 'Terjadi kesalahan pada sistem, silahkan coba beberapa saat lagi ' . $e
                    ];

                    Log::error('Failed to register admin', );

                    return redirect()->back()->withInput()->with('error' , $flash);
                }
            } else {
                $flash = [
                    'title' => 'Terjadi kesalahan',
                    'desc'  => 'Terjadi kesalahan pada sistem, silahkan coba beberapa saat lagi'
                ];

                return redirect()->back()->withInput()->with('error' , $flash);
            }

        } else {
            $flash = [
                'title' => 'Terjadi kesalahan',
                'desc'  => 'Terjadi kesalahan pada sistem, silahkan hubungi admin untuk melanjutkan'
            ];

            return redirect()->back()->withInput()->with('error' , $flash);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Sign Up
            ',
        ];

        return view('pages.auth.admin.register.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate(
                [
                    'email'                 => 'required|email:rfc,dns|unique:users,email',
                    'password'              => 'required|min:8|max:20|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).*$/',
                    'password_confirmation' => 'required|same:password',
                ],
                [
                    'email.required'                => 'Email harus diisi.',
                    'email.email'                   => 'Format email tidak valid.',
                    'email.unique'                  => 'Email sudah digunakan',
                    'password.required'             => 'Password harus diisi.',
                    'password.min'                  => 'Password harus memiliki minimal 8 karakter.',
                    'password.max'                  => 'Password tidak boleh melebihi 20 karakter',
                    'password.regex'                => 'Password harus mengandung setidaknya satu huruf besar, satu angka, dan satu simbol',
                    'password_confirmation.required' => 'Konfirmasi password harus diisi.',
                    'password_confirmation.same'    => 'Konfirmasi password tidak cocok dengan password.',
                ]
            );

            if ($validated) {
                try {
                    $data = [
                        'id'        => Str::uuid(),
                        'email'     => $request->email,
                        'password'  => Hash::make($request->password),
                        'role'      => 'admin'
                    ];

                    $storeData = $this->user->create($data);

                    if ($storeData) {
                        $flash = [
                            'title' => 'Berhasil Mendaftar',
                            'desc'  => 'Data berhasil di simpan, silahkan login untuk mengakses halaman'
                        ];

                        return redirect(route('login'))->with('success' , $flash);
                    } else {
                         $flash = [
                            'title' => 'Terjadi kesalahan',
                            'desc'  => 'Gagal menyimpan data, silahkan coba beberapa saat lagi'
                        ];

                        return redirect()->back()->with('error' , $flash);
                    }
                } catch (Exception $e) {
                    $flash = [
                        'title' => 'Terjadi kesalahan',
                        'desc'  => 'Terjadi kesalahan pada sistem, silahkan coba beberapa saat lagi ' . $e
                    ];

                    Log::error('Failed to register admin', );

                    return redirect()->back()->withInput()->with('error' , $flash);
                }
            } else {
                $flash = [
                    'title' => 'Terjadi kesalahan',
                    'desc'  => 'Terjadi kesalahan pada sistem, silahkan coba beberapa saat lagi'
                ];

                return redirect()->back()->withInput()->with('error' , $flash);
            }

        } else {
            $flash = [
                'title' => 'Terjadi kesalahan',
                'desc'  => 'Terjadi kesalahan pada sistem, silahkan hubungi admin untuk melanjutkan'
            ];

            return redirect()->back()->withInput()->with('error' , $flash);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $flash = [
            'title' => 'Berhasil',
            'desc'  => 'Berhasil keluar, silahkan login untuk mengakses halaman admin kembali',
        ];

        return redirect(route('login'))->with('success', $flash);
    }
}
