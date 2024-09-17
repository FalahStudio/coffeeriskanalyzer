<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function index()
    {
        $getDataProcess = $this->result->where(function($query) {
            $query->where('key', 'like', 'process_fuzzy_%')
                ->orWhere('key', 'like', 'process_ism_%');
        })->get();

        $groupedData = [];

        foreach ($getDataProcess as $item) {
            $keyPart = explode('_', $item->key, 3)[2] ?? null;

            if ($keyPart) {
                if (!isset($groupedData[$keyPart])) {
                    $groupedData[$keyPart] = ['fuzzy' => null, 'ism' => null];
                }

                if (strpos($item->key, 'process_fuzzy_') === 0) {
                    $groupedData[$keyPart]['fuzzy'] = $item;
                } elseif (strpos($item->key, 'process_ism_') === 0) {
                    $groupedData[$keyPart]['ism'] = $item;
                }
            }
        }

        $finalData = [];

        foreach ($groupedData as $keyPart => $items) {
            if ($items['fuzzy'] && $items['ism']) {                
                $finalData[] = [
                    'schemaId' => $items['fuzzy']->schema_id,
                    'fuzzy' => $items['fuzzy'],
                    'ism' => $items['ism']
                ];
            }
        }

        $data = [
            'title' => 'History',
            'dataProcess' => $finalData,
        ];

        return view('pages.user.history.index', $data);
    }

    public function detail($schemaId)
    {
        $getData = $this->schema->where('id', $schemaId)->first();

        if (!$getData) {
            $flash = [
                'title' => 'Skema Tidak Ditemukan',
                'desc'  => 'Periksa kembali pilihan skema anda, atau bisa menghubungi admin.'
            ];

            return redirect()->route('history')->with('error', $flash);
        }

        $getDataProcess = $this->result->where('schema_id', $schemaId)
        ->where(function($query) {
            $query->where('key', 'like', 'process_fuzzy_%')
                ->orWhere('key', 'like', 'process_ism_%');
        })->get();

        if (empty($getDataProcess)) {
            $flash = [
                'title' => 'Skema Tidak Ditemukan',
                'desc'  => 'Periksa kembali pilihan skema anda, atau bisa menghubungi admin.'
            ];

            return redirect()->route('history')->with('error', $flash);
        }

        $groupedData = [];

        foreach ($getDataProcess as $item) {
            $keyPart = explode('_', $item->key, 3)[2] ?? null;

            if ($keyPart) {
                if (!isset($groupedData[$keyPart])) {
                    $groupedData[$keyPart] = ['fuzzy' => null, 'ism' => null];
                }

                if (strpos($item->key, 'process_fuzzy_') === 0) {
                    $groupedData[$keyPart]['fuzzy'] = $item;
                } elseif (strpos($item->key, 'process_ism_') === 0) {
                    $groupedData[$keyPart]['ism'] = $item;
                }
            }
        }

        $finalData = [];

        foreach ($groupedData as $keyPart => $items) {
            if ($items['fuzzy'] && $items['ism']) {                
                $fuzzyData = json_decode(base64_decode($items['fuzzy']->value), true);
                $ismData = json_decode(base64_decode($items['ism']->value), true);
                $riskData = $this->risk->where('schema_id', $schemaId)->first();

                $data_conclusion = explode(" ", $ismData['biner_conclusion']);

                $size = $riskData->risk + 1;
                $matrix = [];
                $index = 0;
                for ($i = 0; $i < $size; $i++) {
                    for ($j = 0; $j < $size; $j++) {
                        $matrix[$i][$j] = intval($data_conclusion[$index]);
                        $index++;
                    }
                }

                $data_chart = [];
                $sum_x = 0;
                $count_x = 0;
                $max_x = PHP_INT_MIN;
                $min_x = PHP_INT_MAX;

                $sum_y= 0;
                $count_y = 0;
                $max_y = PHP_INT_MIN;
                $min_y = PHP_INT_MAX;

                for ($i = 0; $i < $size; $i++) {
                    if ($i === $riskData->risk) {
                        break;
                    }

                    $x = $matrix[$size - 1][$i];
                    $y = $matrix[$i][$size - 1];

                    $sum_x += $x;
                    $count_x++;

                    if ($x > $max_x) {
                        $max_x = $x;
                    }

                    if ($x < $min_x) {
                        $min_x = $x;
                    }

                    $sum_y += $y;
                    $count_y++;

                    if ($y > $max_y) {
                        $max_y = $y;
                    }
                    if ($y < $min_y) {
                        $min_y = $y;
                    }

                    $data_chart[] = [
                        'x' => $x,
                        'y' => $y,
                    ];
                }

                $avg_x = $count_x > 0 ? $sum_x / $count_x : 0;
                $avg_y = $count_y > 0 ? $sum_y / $count_y : 0;

                $data_line_chart = [
                    'x' => [
                        'max' => [
                            'x' => $avg_x,
                            'y' => $max_x + 3
                        ],
                        'min' => [
                            'x' => $avg_x,
                            'y' => $min_x
                        ]
                    ],
                    'y' => [
                        'max' => [
                            'x' => $avg_y,
                            'y' => $max_y + 2
                        ],
                        'min' => [
                            'x' => $avg_y,
                            'y' => $min_y
                        ]
                    ],
                ];

                $dataResult = [];
                foreach ($fuzzyData['output_fuzzy'] as $key => $value) {
                    $dataResult[] = [
                        'component' => $value['risk_component'],
                        'code'      => 'E' . $value['risk_code'],
                        'frpn'      => number_format($value['frpn'], 3, '.', ''),
                        'rank'      => $key++ + 1,
                    ];
                }

                usort($dataResult, function($a, $b) {
                    return $b['frpn'] <=> $a['frpn'];
                });

                $severity = [
                    'Tidak ada pengaruh',
                    'Sistem dapat beroperasi dengan sedikit gangguan',
                    'Sistem dapat beroperasi dengan penurunan pada beberapa performa',
                    'Sistem dapat beroperasi namun dengan penurunan performa yang signifikan',
                    'Sistem tidak dapat beroperasi tanpa kerusakan',
                    'Sistem tidak dapat beroperasi dengan tingkat kerusakan yang kecil',
                    'Sistem tidak dapat beroperasi dengan kerusakan pada peralatan',
                    'Sistem tidak dapat beroperasi dengan kegagalan yang menyebabkan kerusakan',
                    'Tingkat keparahan sangat tinggi dan dengan peringatan',
                    'Tingkat keparahan sangat tinggi dan tanpa peringatan',
                ];
                
                $occurance = [
                    'Kemungkinan Kegagalan <1 dalam 1.500.000',
                    'Kemungkinan Kegagalan 1 dalam 150.000',
                    'Kemungkinan Kegagalan 1 dalam 15.000',
                    'Kemungkinan Kegagalan 1 dalam 2000',
                    'Kemungkinan Kegagalan 1 dalam 400',
                    'Kemungkinan Kegagalan 1 dalam 80',
                    'Kemungkinan Kegagalan 1 dalam 20',
                    'Kemungkinan Kegagalan 1 dalam 8',
                    'Kemungkinan Kegagalan 1 dalam 3',
                    'Kemungkinan Kegagalan >1 dalam 2'
                ];

                $detection = [
                    'Kontrol desain akan mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya',
                    'Kontrol desain sangat tinggi kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya',
                    'Kontrol desain tinggi kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya',
                    'Kontrol desain cukup tinggi kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya',
                    'Kontrol desain sedang kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya',
                    'Kontrol desain kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya',
                    'Kontrol desain sangat kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya',
                    'Kontrol desain kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya',
                    'Kontrol desain sangat kecil kemungkinannya mendeteksi potensi penyebab/mekanisme potensial kegagalan berikutnya',
                    'Kontrol desain tidak dapat mendeteksi penyebab/mekanisme potensial dan mode kegagalan berikutnya'
                ];

                $linguistic = [
                    'Very Low (VL)' => 'Jika dampak/kejadian/deteksi yang ditimbulkan sangat rendah',
                    'Low (L)' => 'Jika dampak/kejadian/deteksi yang ditimbulkan rendah',
                    'Medium (M)' => 'Jika dampak/kejadian/deteksi yang ditimbulkan sedang',
                    'High (H)' => 'Jika dampak/kejadian/deteksi yang ditimbulkan tinggi',
                    'Very High (VH)' => 'Jika dampak/kejadian/deteksi yang ditimbulkan sangat tinggi'
                ];

                $severityEncode = json_encode($severity);
                $occuranceEncode = json_encode($occurance);
                $detectionEncode = json_encode($detection);
                $linguisticEncode = json_encode($linguistic);

                $fuzzyInput = $this->result->where('schema_id', $schemaId)->where('key', 'like', 'fuzzy_%')->get();
                $combinedData = [];

                foreach ($fuzzyInput as $index => $fuzzy) {
                    $decoded = base64_decode($fuzzy->value);
                    $decodedValue = json_decode($decoded, true);

                    $expertNum = $index + 1;

                    foreach (['severity', 'occurance', 'detection'] as $type) {
                        if ($type === 'severity') {
                            $typeKey = 's';
                        } elseif ($type === 'occurance') {
                            $typeKey = 'o';
                        } elseif ($type === 'detection') {
                            $typeKey = 'd';
                        }

                        $expertKey = $typeKey . '_expert' . $expertNum;

                        if (isset($decodedValue[$type])) {
                            $combinedData[$expertKey] = $decodedValue[$type];
                        }
                    }

                    foreach ($decodedValue['linguistic'] as $i => $linguisticArray) {
                        $combinedData['linguistic'][] = $linguisticArray;
                    }
                }

                $finalData = [
                    'dataDescSOD' => [
                        'severity' => base64_encode($severityEncode),
                        'occurance' => base64_encode($occuranceEncode),
                        'detection' => base64_encode($detectionEncode),
                        'linguistic' => base64_encode($linguisticEncode),
                    ],
                    'frpn' => $dataResult,
                    'risk' => $riskData,
                    'fuzzyInput' => $combinedData,
                    'fuzzy' => $fuzzyData,
                    'ism' => $ismData,
                    'chart' => $data_chart,
                    'data_line_chart' => $data_line_chart,
                ];
            }
        }

        $data = [
            'title' => 'Detail',
            'result' => $finalData,
        ];

        return view('pages.user.result.index', $data);
    }
}
