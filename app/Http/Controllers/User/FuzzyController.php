<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FuzzyController extends Controller
{
    public function index($userId, $schemaId)
    {
        $checkSchema = $this->schema->where('id', $schemaId)->first();

        if ($checkSchema) {
            $userInput = $this->result->where('schema_id', $checkSchema->id)->where('key', 'fuzzy_' . $userId)->first();
            $getRiskData = $this->risk->where('schema_id', $checkSchema->id)->first();

            $dataProcessIsm = $this->result->where('schema_id', $checkSchema->id)->where('key', 'process_ism_' . $schemaId)->first();

            if (!$userInput) {
                $data = [
                    'title' => 'Fuzzy Input',
                    'riskData' => $getRiskData,
                    'processIsm' => $dataProcessIsm->value,
                ];

                return view('pages.user.userFuzzy.index', $data);
            }

            $totalUsers = 3;
            $completedUsers = $this->result->where('schema_id', $checkSchema->id)->where('key', 'like', 'fuzzy_%')->distinct('key')->count();

            if ($completedUsers !== $totalUsers) {
                return redirect('/' . $userId . '/schema/' . $checkSchema->id . '/waiting-for-another');
            }
        } else {
            $flash = [
                'title' => 'Skema Tidak Ditemukan',
                'desc'  => 'Periksa kembali pilihan skema anda, atau bisa menghubungi admin jika skema yang di pilih sudah benar namun tidak dapat masuk.'
            ];

            return redirect()->back()->with('error' , $flash);
        }
    }

    public function store(Request $request, $userId, $schemaId)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');
            $values = array_values($data);

            if (in_array('', $values)) {
                return redirect()->back()->withInput()->with('error', 'Semua input harus diisi');
            }

            $totalUsers = 3;
            $completedUsers = $this->result->where('schema_id', $schemaId)->where('key', 'like', 'fuzzy_%')->distinct('key')->count();

            if ($completedUsers !== $totalUsers) {
                $s_codes = [];
                $o_codes = [];
                $d_codes = [];
                $l_values = [];

                foreach ($data as $key => $value) {
                    if (strpos($key, 's_') === 0) {
                        $s_codes[$key] = $value;
                    } elseif (strpos($key, 'o_') === 0) {
                        $o_codes[$key] = $value;
                    } elseif (strpos($key, 'd_') === 0) {
                        $d_codes[$key] = $value;
                    } elseif (strpos($key, 'l_') === 0) {
                        $l_values[$key] = $value;
                    }
                }

                $result = [
                    'severity'    => array_values($this->getValueSODL($s_codes)),
                    'occurance'   => array_values($this->getValueSODL($o_codes)),
                    'detection'   => array_values($this->getValueSODL($d_codes)),
                    'linguistic'  => array_values($this->getValueSODL($l_values)),
                ];

                $resultEncode = json_encode($result);

                $dataInputFuzzy = [
                    'id'        => Str::uuid(),
                    'schema_id' => $schemaId,
                    'key'       => 'fuzzy_' . $userId,
                    'value'     => base64_encode($resultEncode),
                ];

                $savedResultFuzzy = $this->result->create($dataInputFuzzy);

                if ($savedResultFuzzy) {
                    $totalUsersFuzzy = 3;
                    $completedUsersFuzzy = $this->result->where('schema_id', $schemaId)->where('key', 'like', 'fuzzy_%')->distinct('key')->count();

                    if ($completedUsersFuzzy !== $totalUsersFuzzy) {
                        return redirect('/' . $userId . '/schema/' . $schemaId . '/waiting-for-another');
                    }
                } else {
                    $flash = [
                        'title' => 'Terjadi kesalahan',
                        'desc'  => 'Terjadi kesalahan pada sistem, sialahkan coba beberapa saat lagi!'
                    ];

                    return redirect()->back()->withInput()->with('error' , $flash);
                }
            }

            $dataFuzzy = $this->result->where('schema_id', $schemaId)->where('key', 'like', 'fuzzy_%')->get();

            $getAllInputFuzzy = [];

            foreach ($dataFuzzy as $item) {
                $getAllInputFuzzy[] = base64_decode($item->value);
            }

            $dataInput = $getAllInputFuzzy;
            // 'output_ism' => [
            //         'linkage'       => $dataJson['data']['ism']['result_ism']['data_result']['linkage'],
            //         'independent'   => $dataJson['data']['ism']['result_ism']['data_result']['independent'],
            //     ],
            //     'input_fuzzy' => [],

            $outputFuzzyDataRaw = $this->result->where('schema_id', $schemaId)->where('key', 'process_ism_' . $schemaId)->first();
            $outputFuzzyData = base64_decode($outputFuzzyDataRaw->value);
            $outputFuzzyDataDecode = json_decode($outputFuzzyData);

            $dataProcess = [
                'output_ism' => [
                    'linkage'       => $outputFuzzyDataDecode->data_result->linkage,
                    'independent'   => $outputFuzzyDataDecode->data_result->independent,
                ],
                'input_fuzzy' => [],
            ];

            foreach ($dataInput as $item) {
                $item = json_decode($item);

                $severity = $item->severity;
                $occurance = $item->occurance;
                $detection = $item->detection;

                $groupedData = [];
                for ($i = 0; $i < count($severity); $i++) {
                    $groupedData[] = [$severity[$i], $occurance[$i], $detection[$i]];
                }

                $dataProcess['input_fuzzy'][] = [
                    'grouped_data' => $groupedData,
                    'linguistic'  => $item->linguistic,
                ];

            }

            $inputString = json_encode($dataProcess);
            $getRiskData = $this->risk->where('schema_id', $schemaId)->first();
            $getRiskDataDecode64 = base64_decode($getRiskData->data_risk);
            $getRiskDataJson = json_decode($getRiskDataDecode64);

            $processedData = $this->processDataFuzzy($inputString, $getRiskDataJson);
            $decodeProcess = json_decode($processedData, true);

            $transformedData = [];

            foreach ($decodeProcess['data_sod'] as $key => $value) {
                $code = $value[0];
                $name = $value[1];
                $data = $value[2];

                $transformedData[] = [
                    'code' => $code,
                    'name' => $name,
                    'data' => $data,
                ];
            }

            $processFuzzyRaw = [
                'data_sod' => $transformedData,
                'data_linguistic' => $decodeProcess['data_linguistik'],
                'output_fuzzy' => $decodeProcess['output_fuzzy'],
            ];

            $processFuzzyEncode = json_encode($processFuzzyRaw);

            $processFuzzy = [
                'id'        => Str::uuid(),
                'schema_id' => $schemaId,
                'key'       => 'process_fuzzy_' . $schemaId,
                'value'     => base64_encode($processFuzzyEncode),
            ];

            $savedProcessIsm = $this->result->create($processFuzzy);

            if ($savedProcessIsm) {
                $getSchema = $this->schema->where('id', $schemaId)->first();
                $getSchema->status = 1;
                $getSchema->save();
                return redirect('/schema/' . $schemaId . '/result');
            } else {
                $flash = [
                    'title' => 'Terjadi kesalahan',
                    'desc'  => 'Terjadi kesalahan pada sistem, sialahkan coba beberapa saat lagi!'
                ];

                return redirect()->back()->withInput()->with('error' , $flash);
            }


            // $processedData = $this->processDataISM($inputString, $ordo, $dataRisk);
            // $decodeProcess = json_decode($processedData, true);

            // $dataIsmProcess = [
            //     'data_input' => $decodeProcess['data_input'],
            //     'data_mirror' => $decodeProcess['data_mirror'],
            //     'data_biner' => $decodeProcess['data_biner'],
            //     'biner_conclusion' => $decodeProcess['biner_conclusion'],
            //     'level' => $decodeProcess['level'],
            //     'data_result' => [
            //         'independent' => $decodeProcess['outputISM']['independent'],
            //         'linkage' => $decodeProcess['outputISM']['linkage'],
            //         'autonomous' => $decodeProcess['outputISM']['autonomous'],
            //         'dependent' => $decodeProcess['outputISM']['dependent'],
            //     ],
            // ];

            // $encodeIsmProcess = json_encode($dataIsmProcess);

            // $dataFinalProcess = [
            //     'id'        => Str::uuid(),
            //     'schema_id' => $schemaId,
            //     'key'       => 'process_ism_' . $schemaId,
            //     'value'     => base64_encode($encodeIsmProcess),
            // ];

            // $savedProcessIsm = $this->result->create($dataFinalProcess);

            // if ($savedProcessIsm) {
            //     return redirect('/' . $userId . '/schema/' . $schemaId . '/fuzzy');
            // } else {
            //     $flash = [
            //         'title' => 'Terjadi kesalahan',
            //         'desc'  => 'Terjadi kesalahan pada sistem, sialahkan coba beberapa saat lagi!'
            //     ];

            //     return redirect()->back()->withInput()->with('error' , $flash);
            // }
        } else {
            $flash = [
                'title' => 'Terjadi kesalahan',
                'desc'  => 'Terjadi kesalahan pada sistem, silahkan hubungin admin!'
            ];

            return redirect()->back()->withInput()->with('error' , $flash);
        }
    }

    protected function getValueSODL($data)
    {
        $numbers = [];

        foreach ($data as $key => $value) {
            if (preg_match('/(s|o|d)_code_E\d+_(\d+)/', $value, $matches)) {
                $numbers[$key] = (int)$matches[2];
            } elseif (preg_match('/l_([a-zA-Z]+)_(\d+)/', $value, $matches)) {
                $changeValue = (int)$matches[2];

                if ($changeValue === 1) {
                    $dataLinguistic = "VL";
                } elseif ($changeValue === 2) {
                    $dataLinguistic = "L";
                } elseif ($changeValue === 3) {
                    $dataLinguistic = "M";
                } elseif ($changeValue === 4) {
                    $dataLinguistic = "H";
                } elseif ($changeValue === 5) {
                    $dataLinguistic = "VH";
                }
                $numbers[$key] = $dataLinguistic;
            }
        }

        return $numbers;
    }

    /**
     * Fuzzy Process
     */

    private $FuzzyS = [
        10 => [9, 10, 10],
        9 => [8, 9, 10],
        8 => [7, 8, 9],
        7 => [6, 7, 8],
        6 => [5, 6, 7],
        5 => [4, 5, 6],
        4 => [3, 4, 5],
        3 => [2, 3, 4],
        2 => [1, 2, 3],
        1 => [1, 1, 2]
    ];

    private $FuzzyO = [
        10 => [8, 9, 10, 10],
        9 => [8, 9, 10, 10],
        8 => [6, 7, 8, 9],
        7 => [6, 7, 8, 9],
        6 => [3, 4, 6, 7],
        5 => [3, 4, 6, 7],
        4 => [3, 4, 6, 7],
        3 => [1, 2, 3, 4],
        2 => [1, 2, 3, 4],
        1 => [1, 1, 2]
    ];

    private $FuzzyD = [
        10 => [9, 10, 10],
        9 => [8, 9, 10],
        8 => [7, 8, 9],
        7 => [6, 7, 8],
        6 => [5, 6, 7],
        5 => [4, 5, 6],
        4 => [3, 4, 5],
        3 => [2, 3, 4],
        2 => [1, 2, 3],
        1 => [1, 1, 2]
    ];

    private $FuzzyL = [
        'VL' => [0, 0, 0.25],
        'L' => [0, 0.25, 0.5],
        'M' => [0.25, 0.5, 0.75],
        'H' => [0.5, 0.75, 1],
        'VH' => [0.75, 1, 1]
    ];

    private function create_pakar($role, $weight)
    {
        return [
            'role' => $role,
            'weight' => $weight,
            'Severity' => 0,
            'Occurance' => 0,
            'Detection' => 0,
            'LS' => '',
            'LO' => '',
            'LD' => ''
        ];
    }

    private function calculate_ris($pakar_list)
    {
        $weightxS = 0;

        foreach ($pakar_list as $pakar) {
            foreach ($this->FuzzyS[$pakar['Severity']] as $number) {
                $weightxS += $pakar['weight'] * $number;
            }
        }

        $ris = ($weightxS / 100) / 3;
        return round($ris, 2);
    }

    private function calculate_rio($pakar_list)
    {
        $weightxO = 0;

        foreach ($pakar_list as $pakar) {
            foreach ($this->FuzzyO[$pakar['Occurance']] as $number) {
                $weightxO += $pakar['weight'] * $number;
            }
        }

        $rio = ($weightxO / 100) / 3;
        return round($rio, 2);
    }

    private function calculate_rid($pakar_list)
    {
        $weightxD = 0;

        foreach ($pakar_list as $pakar) {
            foreach ($this->FuzzyD[$pakar['Detection']] as $number) {
                $weightxD += $pakar['weight'] * $number;
            }
        }

        $rid = ($weightxD / 100) / 3;
        return round($rid, 2);
    }

    private function WSeverity($listPakar)
    {
        $weightxS = 0;
        foreach ($listPakar as $pakar) {
            if ($pakar['LS'] == '') {
                return 0;
            }
            foreach ($this->FuzzyL[$pakar['LS']] as $number) {
                $weightxS += $pakar['weight'] * $number;
            }
        }
        $S = ($weightxS / 100) / 3;

        return round($S, 2);
    }

    private function WOccurance($listPakar)
    {
        $weightxS = 0;
        foreach ($listPakar as $pakar) {
            if ($pakar['LO'] == '') {
                return 0;
            }
            foreach ($this->FuzzyL[$pakar['LO']] as $number) {
                $weightxS += $pakar['weight'] * $number;
            }
        }
        $S = ($weightxS / 100) / 3;
        return round($S, 2);
    }

    private function WDetection($listPakar)
    {
        $weightxS = 0;
        foreach ($listPakar as $pakar) {
            if ($pakar['LD'] == '') {
                return 0;
            }
            foreach ($this->FuzzyL[$pakar['LD']] as $number) {
                $weightxS += $pakar['weight'] * $number;
            }
        }
        $S = ($weightxS / 100) / 3;
        return round($S, 2);
    }

    private function WTotal($S, $O, $D)
    {
        return round($S + $O + $D, 3);
    }


    function calculate_rank($vector)
    {
        $a = [];
        $rank = 1;

        $sortedVector = $vector;
        rsort($sortedVector);

        foreach ($sortedVector as $num) {
            if (!array_key_exists($num, $a)) {
                $a[$num] = $rank;
                $rank++;
            }
        }

        $result = [];
        foreach ($vector as $i) {
            $result[] = $a[$i];
        }

        return $result;
    }

    private function matrix_to_string($matrix)
    {
        $flattened = [];
        foreach ($matrix as $row) {
            foreach ($row as $element) {
                $flattened[] = strval($element);
            }
        }

        $matrix_str = implode(' ', $flattened);

        return $matrix_str;
    }


    public function processDataFuzzy($data, $riskData)
    {
        $processedData = $data;
        $outputISM = json_decode($processedData, true);

        $listCode = array_merge($outputISM['output_ism']['linkage'], $outputISM['output_ism']['independent']);

        sort($listCode);

        for ($i = 0; $i < count($listCode); $i++) {
            if (count($listCode) < 2) {
                continue;
            } elseif (intval(substr($listCode[1], 1)) > intval(substr($listCode[count($listCode) - 1], 1))) {
                array_push($listCode, array_splice($listCode, 1, 1)[0]);
            }
        }

        $listPakar = [
            $this->create_pakar('Expert1', 40),
            $this->create_pakar('Expert2', 30),
            $this->create_pakar('Expert3', 30)
        ];

        $listResiko = [];

        foreach ($listCode as $code) {
            $risk = [
                'riskCode' => $code,
                'riskName' => $riskData[$code - 1],
                'listPakar' => $listPakar,
            ];

            $listResiko[] = $risk;
        }

        $simulated_input_pakar1 = $outputISM['input_fuzzy'][0]['grouped_data'];
        $simulated_input_pakar2 = $outputISM['input_fuzzy'][1]['grouped_data'];
        $simulated_input_pakar3 = $outputISM['input_fuzzy'][2]['grouped_data'];
        $simulated_input = [$simulated_input_pakar1, $simulated_input_pakar2, $simulated_input_pakar3];

        $P1L = $outputISM['input_fuzzy'][0]['linguistic'];
        $P2L = $outputISM['input_fuzzy'][1]['linguistic'];
        $P3L = $outputISM['input_fuzzy'][2]['linguistic'];
        $simulated_language = [$P1L, $P2L, $P3L];

        $list_resiko_data = [];

        foreach ($simulated_input as $i => $pakar_list) {
            foreach ($pakar_list as $j => $values) {
                $listResiko[$j]['listPakar'][$i]['Severity'] = $values[0];
                $listResiko[$j]['listPakar'][$i]['Occurance'] = $values[1];
                $listResiko[$j]['listPakar'][$i]['Detection'] = $values[2];
            }
        }

        for ($i = 0; $i < count($listResiko); $i++) {
            foreach ($listResiko[$i]['listPakar'] as $j => $pakar) {
                $listResiko[$i]['listPakar'][$j]['LS'] = $simulated_language[$j][0];
                $listResiko[$i]['listPakar'][$j]['LO'] = $simulated_language[$j][1];
                $listResiko[$i]['listPakar'][$j]['LD'] = $simulated_language[$j][2];
            }
        }

        foreach ($listPakar as $i => $values) {
            $values['LS'] = $simulated_language[$i][0];
            $values['LO'] = $simulated_language[$i][1];
            $values['LD'] = $simulated_language[$i][2];
            $listPakar[$i] = $values;
        }

        foreach ($listResiko as $key => $risk) {
            $risk['ris'] = $this->calculate_ris($risk['listPakar']);
            $risk['rio'] = $this->calculate_rio($risk['listPakar']);
            $risk['rid'] = $this->calculate_rid($risk['listPakar']);

            $listResiko[$key] = $risk;
        }

        $WS = round($this->WSeverity($listPakar) / $this->WTotal($this->WSeverity($listPakar), $this->WOccurance($listPakar), $this->WDetection($listPakar)), 3);
        $WO = round($this->WOccurance($listPakar) / $this->WTotal($this->WSeverity($listPakar), $this->WOccurance($listPakar), $this->WDetection($listPakar)), 3);
        $WD = round($this->WDetection($listPakar) / $this->WTotal($this->WSeverity($listPakar), $this->WOccurance($listPakar), $this->WDetection($listPakar)), 3);

        $outputFuzzy = [];

        foreach ($listResiko as $risk) {
            $dictjson = [];
            $dictjson['risk_code'] = $risk['riskCode'];
            $dictjson['risk_component'] = $risk['riskName'];
            $dictjson['s_data'] = round(pow($risk['ris'], $WS), 3);
            $dictjson['o_data'] = round(pow($risk['rio'], $WO), 3);
            $dictjson['d_data'] = round(pow($risk['rid'], $WD), 3);
            $dictjson['frpn'] = round($dictjson['s_data'] * $dictjson['o_data'] * $dictjson['d_data'], 3);

            $outputFuzzy[] = $dictjson;
        }

        $listRank = [];
        foreach ($outputFuzzy as $row) {
            $listRank[] = $row['frpn'];
        }

        $rank = $this->calculate_rank($listRank);

        $i = 0;
        foreach ($outputFuzzy as &$row) {
            $row['rank'] = $rank[$i];
            $i++;
        }
        unset($row);

        $data_input = $simulated_input;
        $result_FUZZY = [];

        $result_FUZZY["data_sod"] = [];


        for ($i = 0; $i < count($data_input); $i++) {
            $result_FUZZY["data_sod"]["risk" . ($i+1)] = [
                'E' . $i + 1,
                $riskData[$i],
                $data_input[0][0][$i] + $data_input[1][0][$i] + $data_input[2][0][$i]
            ];
        }

        $result_FUZZY["data_linguistik"] = $this->matrix_to_string($simulated_language);

        $result_FUZZY["output_fuzzy"] = $outputFuzzy;

        return json_encode($result_FUZZY);
    }

}
