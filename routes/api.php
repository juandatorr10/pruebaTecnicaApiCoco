<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('pokemons', 'Pokemon\PokemonController@getPokemons');
Route::get('searchPokemons', 'Pokemon\PokemonController@searchPokemons');
Route::get('identificationTest/{idPokemon}', 'Pokemon\PokemonController@identificationTest');
