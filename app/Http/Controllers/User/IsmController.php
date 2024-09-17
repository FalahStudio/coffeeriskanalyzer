<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    }

    public function store(Request $request, $userId, $schemaId)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');
            $values = array_values($data);

            if (in_array('', $values)) {
                $flash = [
                    'title' => 'Terjadi Kesalahan',
                    'desc'  => 'Semua input harus diisi'
                ];
                return redirect()->back()->withInput()->with('error', $flash);
            }
            
            $data = implode(' ', $values);

            $totalUsers = 3;
            $completedUsers = $this->result->where('schema_id', $schemaId)->where('key', 'like', 'ism_%')->distinct('key')->count();

            if ($completedUsers !== $totalUsers) {
                $dataResultIsm = [
                    'id'        => Str::uuid(),
                    'schema_id' => $schemaId,
                    'key'       => 'ism_' . $userId,
                    'value'     => base64_encode($data),
                ];

                $savedResultIsm = $this->result->create($dataResultIsm);
                
                if ($savedResultIsm) {
                    $totalUsersFuzzy = 3;
                    $completedUsersFuzzy = $this->result->where('schema_id', $schemaId)->where('key', 'like', 'ism_%')->distinct('key')->count();

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

            $dataIsm = $this->result->where('schema_id', $schemaId)->where('key', 'like', 'ism_%')->get();

            $getAllInputIsm = [];

            foreach ($dataIsm as $item) {

                $getAllInputIsm[] = base64_decode($item->value);
            }

            $inputString = implode(',', $getAllInputIsm);
            $riskData = $this->risk->where('schema_id', $schemaId)->first();
            $ordo = $riskData->risk;
            $dataRisk = $riskData->data_risk;
            
            $processedData = $this->processDataISM($inputString, $ordo, $dataRisk);
            $decodeProcess = json_decode($processedData, true);
            
            $dataIsmProcess = [
                'data_input' => $decodeProcess['data_input'],
                'data_mirror' => $decodeProcess['data_mirror'],
                'data_biner' => $decodeProcess['data_biner'],
                'biner_conclusion' => $decodeProcess['biner_conclusion'],
                'level' => $decodeProcess['level'],
                'data_result' => [
                    'independent' => $decodeProcess['outputISM']['independent'],
                    'linkage' => $decodeProcess['outputISM']['linkage'],
                    'autonomous' => $decodeProcess['outputISM']['autonomous'],
                    'dependent' => $decodeProcess['outputISM']['dependent'],
                ],
            ];

            $encodeIsmProcess = json_encode($dataIsmProcess);

            $dataFinalProcess = [
                'id'        => Str::uuid(),
                'schema_id' => $schemaId,
                'key'       => 'process_ism_' . $schemaId,
                'value'     => base64_encode($encodeIsmProcess),
            ];

            $savedProcessIsm = $this->result->create($dataFinalProcess);

            if ($savedProcessIsm) {
                return redirect('/' . $userId . '/schema/' . $schemaId . '/fuzzy');
            } else {
                $flash = [
                    'title' => 'Terjadi kesalahan',
                    'desc'  => 'Terjadi kesalahan pada sistem, sialahkan coba beberapa saat lagi!'
                ];

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

    public function processDataISM($processed_data, $ordoData, $dataRisk)
    {
        if (!empty($processed_data)) {
            $ordo = $ordoData;
            $matrix = array_fill(0, $ordo, array_fill(0, $ordo, 'X'));
            $varRisk = json_decode(base64_decode($dataRisk));

            $result_ISM = [];
            $result_ISM['resiko'] = $varRisk;
            
            $data_input = explode(',', $processed_data);
            $result_ISM["data_input"] = $data_input;
            
            $result_ISM["data_mirror"] = [];
            foreach ($result_ISM["data_input"] as $data) {
                $result_ISM["data_mirror"][] = $this->inputToMirror($data, $ordo);
            }
            
            $result_ISM["data_biner"] = [];
            foreach ($result_ISM["data_mirror"] as $data) {
                $result_ISM["data_biner"][] = $this->mirrorToBiner($data);
            }
        
            $biner_conclusion = "";
            for ($i = 0; $i < strlen($result_ISM["data_biner"][0]); $i++) {
                if ($i % 2 == 0) {
                    $lst2 = [
                        $result_ISM["data_biner"][0][$i],
                        $result_ISM["data_biner"][1][$i],
                        $result_ISM["data_biner"][2][$i]
                    ];
                    $biner_conclusion .= array_search(max(array_count_values($lst2)), array_count_values($lst2)) . ' ';
                }
            }

            $result_ISM["biner_conclusion"] = $biner_conclusion;
        
            $matrix = $this->stringToMatrix(str_replace(' ', '', $biner_conclusion), $ordo, $ordo);
        
            $DrP = [];
            $DeP = [];
            foreach ($matrix as $i => $row) {
                $DrP[] = count(array_filter($row, fn($val) => $val === '1'));
            }
            for ($i = 0; $i < count($matrix); $i++) {
                $DeP[] = array_reduce($matrix, fn($carry, $row) => $carry + ($row[$i] === '1' ? 1 : 0), 0);
            }

            $ranks = $this->calculateRanks($DrP);
            $result_ISM['level'] = $this->createLevelDict($varRisk, $ranks);
        
            $DrPAVG = $this->average($DrP);
            $DePAVG = $this->average($DeP);
        
            $outputISM = [
                'independent' => [],
                'linkage' => [],
                'autonomous' => [],
                'dependent' => []
            ];

            for ($i = 0; $i < count($DeP); $i++) {
                if ($DrP[$i] > $DrPAVG && $DeP[$i] < $DePAVG) {
                    $outputISM['independent'][] = $i + 1;
                } elseif ($DrP[$i] > $DrPAVG && $DeP[$i] > $DePAVG) {
                    $outputISM['linkage'][] = $i + 1;
                } elseif ($DrP[$i] < $DrPAVG && $DeP[$i] > $DePAVG) {
                    $outputISM['dependent'][] = $i + 1;
                } elseif ($DrP[$i] < $DrPAVG && $DeP[$i] < $DePAVG) {
                    $outputISM['autonomous'][] = $i + 1;
                }
            }

            $result_ISM["outputISM"] = $outputISM;
            
            foreach ($matrix as $i => &$row) {
                $row[] = $DrP[$i];
            }
            $DeP[] = array_sum($DrP);
            $matrix[] = $DeP;
            $result_ISM["biner_conclusion"] = $this->matrixToString($matrix);

            $json_data = json_encode($result_ISM, JSON_PRETTY_PRINT);
        
            return $json_data;
        }
    }

    protected function inputToMirror($string_data, $ordo) {
        $matrix = array_fill(0, $ordo, array_fill(0, $ordo, 'X'));
        $list_data = explode(' ', $string_data);
        $index = 0;

        for ($i = 0; $i < $ordo; $i++) {
            for ($j = 0; $j < $ordo; $j++) {
                if ($i != $j && $i < $j) {
                    $matrix[$i][$j] = $list_data[$index];
                    $index++;
                }
            }
        }
    
        for ($i = 0; $i < $ordo; $i++) {
            for ($j = 0; $j < $ordo; $j++) {
                if ($i != $j && $i > $j) {
                    if ($matrix[$j][$i] == 'V') {
                        $matrix[$i][$j] = 'A';
                    } elseif ($matrix[$j][$i] == 'A') {
                        $matrix[$i][$j] = 'V';
                    } elseif ($matrix[$j][$i] == 'X') {
                        $matrix[$i][$j] = 'X';
                    } elseif ($matrix[$j][$i] == 'O') {
                        $matrix[$i][$j] = 'O';
                    }
                }
            }
        }

        $full_str = '';
        foreach ($matrix as $row) {
            $full_str .= implode(' ', $row) . ' ';
        }

        return $full_str;
    }

    protected function mirrorToBiner($string_data) {
        $new_str = "";
        for ($i = 0; $i < strlen($string_data); $i++) {
            switch ($string_data[$i]) {
                case 'V':
                    $new_str .= '1';
                    break;
                case 'A':
                    $new_str .= '0';
                    break;
                case 'X':
                    $new_str .= '1';
                    break;
                case 'O':
                    $new_str .= '0';
                    break;
                default:
                    $new_str .= $string_data[$i];
                    break;
            }
        }
        return $new_str;
    }

    protected function stringToMatrix($input_string, $m, $n) {
        if ($m * $n != strlen($input_string)) {
            throw new Exception("The dimensions of the matrix do not match the length of the input string.");
        }

        $matrix = [];
        for ($i = 0; $i < $m; $i++) {
            $row = substr($input_string, $i * $n, $n);
            $matrix[] = str_split($row);
        }

        return $matrix;
    }

    protected function matrixToString($matrix) {
        $flattened = [];
        foreach ($matrix as $row) {
            foreach ($row as $element) {
                $flattened[] = strval($element);
            }
        }
        $matrix_str = implode(' ', $flattened);
        return $matrix_str;
    }

    protected function calculateRanks($DrP)
    {
        $max_rank = max($DrP);
        $reversed_DrP = [];
        
        foreach ($DrP as $rank) {
            $reversed_DrP[] = $max_rank - $rank + 1;
        }
        
        return $reversed_DrP;
    }

    protected function createLevelDict($codes, $ranks)
    {
        $codeRankPairs = array_map(null, $codes, $ranks);

        usort($codeRankPairs, function($a, $b) {
            return $a[1] <=> $b[1];
        });

        $levelDict = [];
        $previousRank = null;
        $currentLevel = 1;

        foreach ($codeRankPairs as $key => $pair) {
            list($code, $rank) = $pair;

            if ($rank !== $previousRank) {
                $currentLevel = $rank;
            }
            
            $level = 'Level ' . $currentLevel;

            if (!array_key_exists($level, $levelDict)) {
                $levelDict[$level] = [];
            }

            $levelDict[$level][] = $code;
            $previousRank = $rank;
        }

        $dataLevelDict = [];

        foreach ($levelDict as $value) {
            $dataLevelDict[] = $value;
        }

        return $dataLevelDict;
    }

    protected function average($lst) {
        return array_sum($lst) / count($lst);
    }
}
