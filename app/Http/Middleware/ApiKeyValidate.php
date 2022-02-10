<?php

namespace App\Http\Middleware;

use Closure;

class ApiKeyValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->has("api_key")){
            $response = ['status' => 401, 'message' => 'Unauthorized access'];
            return response()->json($response, 401);
        }

        if(!$request->has("api_key")){
            $api_key = config('apipokemon.apipokemon.api_key');
            if($request->input("api_key") != $api_key){
                $response = ['status' => 401, 'message' => 'ApiKey invalidate'];
                return response()->json($response, 401);
            }
        }

        return $next($request);
    }
}
