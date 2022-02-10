<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Controllers\Controller;
use App\Traits\ApiClientTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PokemonController extends Controller
{
    //
    use ApiClientTrait;

    /**
     * Method for get pokemones with limit 100
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPokemons(){
        $url_complementary = 'pokemon?limit=100';
        $response = $this->apiClient('GET', $url_complementary);
        $pokemons = json_decode($response->getBody()->getContents())->results;
        return response()->json($pokemons);
    }

    /**
     * Method for searching pokemons with different parameters
     * Example http://localhost:8000/api/searchPokemons?ability=4&type=5
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchPokemons(Request $request){

        $urls = $request->all();
        $pokemons = [];

        foreach ($urls as $key => $url) {
            $url_complementary = $key.'/'.$url;
            $response = $this->apiClient('GET', $url_complementary);
            array_push($pokemons, (json_decode($response->getBody()->getContents())->pokemon));
        }

        $clearArray = array_unique($pokemons[0], SORT_REGULAR);

        return response()->json($clearArray);
    }
}
