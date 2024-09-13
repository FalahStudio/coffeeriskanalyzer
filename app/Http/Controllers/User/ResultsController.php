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

                $avg_x_formatted = number_format($avg_x / 10, 2, '.', '');
                $avg_y_formatted = number_format($avg_y / 10, 2, '.', '');

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
                    return $a['rank'] <=> $b['rank'];
                });

                $finalData = [
                    'frpn' => $dataResult,
                    'risk' => $riskData,
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
