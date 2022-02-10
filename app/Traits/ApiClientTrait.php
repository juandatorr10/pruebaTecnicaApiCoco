<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

trait ApiClientTrait {

    public function apiClient($method, $url_complementary, $form_params = [], $timeout = 30.0, $pokeApi = 1){

        try {
            $base_uri = config('apipokemon.apipokemon.url_base');

            if($pokeApi === 0){
                $base_uri = config('apipokemon.apipokemon.url_base_identification_test');
            }
            $client = new Client([
                'base_uri' => $base_uri,
                'timeout' => $timeout,
                'body' => json_encode($form_params),
            ]);
            return $client->request($method, $url_complementary, ['form_params' => $form_params]);
        }catch (\Exception $exception){
            return response()->json(['error' => 'error'.' '.$exception->getMessage()], 400);
        }
    }
}

