<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Controllers\Controller;
use App\Models\Pokemon\PokemonModel;
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

    /**
     * Method that looks for the pokemon sent by parameter
     * @param $idPokemon
     * @return mixed
     */
    public function getPokemon($idPokemon){
        $url_complementary = 'pokemon/'.$idPokemon;
        $response = $this->apiClient('GET', $url_complementary);
        $pokemon = json_decode($response->getBody()->getContents());
        return $pokemon;
    }

    /**
     * Method that sends an object to identify the test
     */
    public function identificationTest($idPokemon){
        // Search pokemon
        $getPokemon = $this->getPokemon($idPokemon);

        // Attributes Object PokemonModel
        $id = 'juandatorr@gmail.com';
        $name = $getPokemon->name;
        $abilities = $getPokemon->abilities;
        $weight = $getPokemon->weight;

        //Object PokemonModel
        $pokemon = new PokemonModel($id, $name, $abilities, $weight);

        $response = $this->apiClient('GET', '', $pokemon, 30, 0);
        $data = $response->getBody()->getContents();

        return response()->json($data);
    }
}
