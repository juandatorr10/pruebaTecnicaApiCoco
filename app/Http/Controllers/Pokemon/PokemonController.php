<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Controllers\Controller;
use App\Traits\ApiClientTrait;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    //
    use ApiClientTrait;

    /*
     * Method for get pokemones with limit 100
     */
    public function getPokemones(){
        $url_complementary = 'pokemon?limit=100';
        $response = $this->apiClient('GET', $url_complementary);
        $pokemones = json_decode($response->getBody()->getContents())->results;
        return response()->json($pokemones);
    }
}
