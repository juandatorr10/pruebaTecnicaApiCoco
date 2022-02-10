<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ApiClientTrait {

    public function apiClient($method, $url_complementary, $form_params = [], $timeout = 30.0){
        try {
            $client = new Client([
                'base_uri' => config('apipokemon.apipokemon.url_base'),
                'timeout' => $timeout,
            ]);
            return $client->request($method, $url_complementary, ['form_params' => $form_params]);
        }catch (\Exception $exception){
            return response()->json(['error' => 'error'.' '.$exception->getMessage()], 400);
        }
    }
}

