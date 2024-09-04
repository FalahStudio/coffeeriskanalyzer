<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class UserAuthentication extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $data = [
            'title' => 'Sign In',
        ];

        return view('pages.auth.user.login.index', $data);
    }

    public function checkMail(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate(
                [
                    'email' => 'required|email:rfc,dns',
                ],
                [
                    'email.required' => 'Email harus diisi.',
                    'email.email'    => 'Format email tidak valid.',
                ]
            );

            try {
                $email = $request->email;

                $checkEmail = $this->user->where('email', $email)->first();
                
                if ($checkEmail) {
                    return redirect('/' . $checkEmail->id);
                } else {
                    $flash = [
                        'title' => 'Email Tidak Ditemukan!',
                        'desc'  => 'Pastikan Anda telah memasukkan alamat email yang benar dan ejaannya sesuai dengan yang terdaftar. Coba lagi atau periksa email yang Anda gunakan.'
                    ];

                    return redirect()->back()->withInput()->with('error' , $flash);
                }

            } catch (Exception $error) {
                $flash = [
                    'title' => 'Terjadi kesalahan',
                    'desc'  => 'Terjadi kesalahan pada sistem, silahkan coba beberapa saat lagi ' . $error
                ];

                Log::error('Failed to register admin', );

                return redirect()->back()->withInput()->with('error' , $flash);
            }

        } else {
            $flash = [
                'title' => 'Terjadi kesalahan',
                'desc'  => 'Terjadi kesalahan pada sistem, silahkan hubungin admin!'
            ];

            return redirect()->back()->withInput()->with('error' , $flash);
        }
    }

    public function loginUser($userId)
    {
        $checkId = $this->user->where('id', $userId)->first();

        if (!$checkId) {
            $flash = [
                'title' => 'Email Tidak Ditemukan!',
                'desc'  => 'Pastikan Anda telah memasukkan alamat email yang benar dan ejaannya sesuai dengan yang terdaftar. Coba lagi atau periksa email yang Anda gunakan.'
            ];

            return redirect()->route('home')->with('error', $flash);
        }

        $getUser = $this->userCredential->where('user_id_one', $userId)->orWhere('user_id_two', $userId)->orWhere('user_id_three', $userId)->get();
        $schemaData = [];
        $today = Carbon::today()->toDateString();

        foreach ($getUser as $userCredential) {
            $getSchema = $this->schema->where('user_id', $userCredential->id)->where('end_date', '>=', $today)->where('status', '!=', 1)->get();

            foreach ($getSchema as $schema) {
                $schemaData[] = $schema;
            }
        }

        $data = [
            'title' => 'Skema Resiko',
            'schemaData' => $schemaData,

        ];

        return view('pages.auth.user.schema.index', $data);
    }

    public function loginUserCheck(Request $request, $userId)
    {
        if ($request->isMethod('POST')) {
            $request->validate(
                [
                    'schema' => 'required',
                ],
                [
                    'schema.required' => 'Skema harus di pilih.',
                ]
            );

            $schema = $request->schema;
            $checkSchema = $this->schema->where('id', $schema)->first();


            if ($checkSchema) {
                $userInput = $this->result->where('schema_id', $checkSchema->id)->where('key', 'ism_' . $userId)->first();

                if (!$userInput) {
                    return redirect('/' . $userId . '/schema/' . $checkSchema->id . '/ism');
                }

                $totalUsers = 3;
                $completedUsers = $this->result->where('schema_id', $checkSchema->id)->where('key', 'like', 'ism_%')->distinct('key')->count();

                if ($completedUsers !== $totalUsers) {
                    return redirect('/' . $userId . '/schema/' . $checkSchema->id . '/waiting-for-another');
                }
                
                return redirect('/' . $userId . '/schema/' . $checkSchema->id . '/fuzzy');
            } else {
                $flash = [
                    'title' => 'Skema Tidak Ditemukan',
                    'desc'  => 'Periksa kembali pilihan skema anda, atau bisa menghubungi admin jika skema yang di pilih sudah benar namun tidak dapat masuk.'
                ];

                return redirect()->back()->with('error' , $flash);
            }
        } else {
            $flash = [
                'title' => 'Terjadi kesalahan',
                'desc'  => 'Terjadi kesalahan pada sistem, silahkan hubungin admin!'
            ];

            return redirect()->back()->withInput()->with('error' , $flash);
        }
    }
}
