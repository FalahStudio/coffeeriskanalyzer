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
        $data = [
            'title' => 'Detail',
        ];

        return view('pages.user.result.index', $data);
    }
}
