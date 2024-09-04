<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title'      => 'Dashboard',
            'schemaData' => $this->risk->all(),
        ];

        return view('pages.admin.dashboard.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            if ($request->statusModal === 'createRisk') {
                return $this->store($request->all());
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
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $emails = [
            $request['expert_one'],
            $request['expert_two'],
            $request['expert_three'],
        ];

        $existingEmails = $this->user->whereIn('email', $emails)->pluck('email')->toArray();
        $newEmails = array_diff($emails, $existingEmails);

        if (!empty($newEmails)) {
            foreach ($newEmails as $email) {
                $data = [
                    'id'        => Str::uuid(),
                    'email'     => $email,
                    'password'  => Hash::make('coffeeriskanalyzer.expert'),
                    'role'      => 'pakar'
                ];

                $this->user->create($data);
            }
        }

        $getIdUser = $this->user->whereIn('email', $emails)->pluck('id')->toArray();

        $dataExpert = [
            'id'            => Str::uuid(),
            'user_id_one'   => $getIdUser[0],
            'user_id_two'   => $getIdUser[1],
            'user_id_three' => $getIdUser[2],
        ];

        $expertStore = $this->userCredential->create($dataExpert);

        if ($expertStore) {
            $dataSchema = [
                'id'        => Str::uuid(),
                'user_id'   => $expertStore->id,
                'end_date'  => Carbon::createFromFormat('d/m/Y', $request['end_date'])->format('Y-m-d'),
                'status'    => 0,
            ];

            $schemaStore = $this->schema->create($dataSchema);

            if ($schemaStore) {
                $riskData = array_filter($request, function ($key) {
                    return strpos($key, 'risk_') === 0;
                }, ARRAY_FILTER_USE_KEY);

                $riskValues = array_values($riskData);
                $riskString = implode(', ', $riskValues);

                $riskData = base64_encode($riskString);

                $dataRisk = [
                    'id'        => Str::uuid(),
                    'schema_id' => $schemaStore->id,
                    'risk'      => $request['risk'],
                    'data_risk' => $riskData,
                ];

                $riskStore = $this->risk->create($dataRisk);

                if ($riskStore) {
                    $flash = [
                        'title' => 'Berhasil',
                        'desc'  => 'Berhasil menyimpan skema resiko, silahkan cek berkala untuk melihat hasil akhir pengisian skema oleh pakar'
                    ];

                    return redirect()->route('dashboard')->with('success', $flash);
                } else {
                    $this->schema->destroy($schemaStore->id);
                    $this->userCredential->destroy($expertStore->id);

                    $flash = [
                        'title' => 'Terjadi kesalahan',
                        'desc'  => 'Silahkan coba beberapa saat lagi'
                    ];

                    return redirect()->route('dashboard')->with('error', $flash);
                }
            } else {
                $this->userCredential->destroy($expertStore->id);

                $flash = [
                    'title' => 'Terjadi kesalahan',
                    'desc'  => 'Silahkan coba beberapa saat lagi'
                ];

                return redirect()->route('dashboard')->with('error', $flash);
            }
        } else {
            $flash = [
                'title' => 'Terjadi kesalahan',
                'desc'  => 'Silahkan coba beberapa saat lagi'
            ];

            return redirect()->route('dashboard')->with('error', $flash);
        }
    }

    public function getSchema($id)
    {
        $getData = $this->risk->where('id', $id)->first();

        $data = [
            'expert_one' => $getData->schema->userCredential->userOne->email,
            'expert_two' => $getData->schema->userCredential->userTwo->email,
            'expert_three' => $getData->schema->userCredential->userThree->email,
            'end_date'   => Carbon::createFromFormat('Y-m-d', $getData->schema->end_date)->format('d/m/Y'),
            'risk'       => $getData->risk,
            'data_risk'  => $getData->data_risk,
        ];

        return response()->json($data, 200);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
