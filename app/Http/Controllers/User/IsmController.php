<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IsmController extends Controller
{
    public function index($userId, $schemaId)
    {
        $checkSchema = $this->schema->where('id', $schemaId)->first();

        if ($checkSchema) {
            $userInput = $this->result->where('schema_id', $checkSchema->id)->where('key', 'ism_' . $userId)->first();
            $getRiskData = $this->risk->where('schema_id', $checkSchema->id)->first();

            if (!$userInput) {
                $data = [
                    'title' => 'ISM Input',
                    'riskData' => $getRiskData,
                ];
                
                return view('pages.user.userIsm.index', $data);
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
        // $getData = $this->readDataJson();
        // $userData = [];
        // $dataJson = [];

        // foreach ($getData as $value) {
        //     if ($value['status']) {
        //         continue;
        //     }

        //     foreach ($value['user'] as $item) {
        //         if ($item['id_user'] === $id) {
        //             $userData = $item;
        //             $dataJson = $value;
        //             break 2;
        //         }
        //     }
        // }

        // $checkInputIsmUser = false;

        // foreach ($dataJson['data']['ism']['data_input'] as $value) {
        //     if ($userData['email']  === $value['email']) {
        //         $checkInputIsmUser = true;
        //         break;
        //     }
        // }

        // if ($checkInputIsmUser) {
        //     return redirect()->route('waiting')->with('error', 'Kamu sebelumnya telah mendaftar, silahkan tunggu yang lain untuk melanjutkan!');
        // }

        // return view('Pages.users.ism.index');
    }
}
