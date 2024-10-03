<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FuzzyResults extends Controller
{
    public function index($schemaId)
    {
        $getResults = $this->result->where('schema_id', $schemaId)->where('key', 'like', 'process_fuzzy_%')->first();
        $fuzzyData = json_decode(base64_decode($getResults->value), true);

        $dataResult = [];
        foreach ($fuzzyData['output_fuzzy'] as $key => $value) {
            $dataResult[] = [
                'component' => $value['risk_component'],
                'code'      => 'E' . $value['risk_code'],
                'frpn'      => number_format($value['frpn'], 3, '.', ''),
                'rank'      => $key++ + 1,
            ];
        }

        $data = [
            'title' => 'Detail',
            'result' => $dataResult,
            'schemaId' => $schemaId,
        ];

        return view('pages.user.result.fuzzyResult.index', $data);
    }
}
