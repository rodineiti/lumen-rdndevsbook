<?php

namespace App\Http\Controllers\Api\V2;

use App\Support\SupportCurl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CepController extends Controller
{
    public function show($cep)
    {
        $cep = str_replace("-", "", $cep);
        $response = json_decode(SupportCurl::curl_get("http://viacep.com.br/ws/".$cep."/json"));

        if ($response && isset($response->status)) {
            return response()->json(['error' => true, 'message' => 'Não foi possível recuperar os dados do cep']);
        }

        $data = (object)[
            'uf' => $response->uf,
            'zipcode' => $response->cep,
            'city' => $response->localidade,
        ];

        return response()->json(['error' => false, 'data' => $data]);
    }
}
