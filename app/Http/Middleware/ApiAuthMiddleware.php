<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthMiddleware
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
        //dd($request->all());
        $response = [];

        $reqkey = $request->get('key');
        $reqtoken = $request->get('token');
        $key = env('KEY');
        $token = env('TOKEN');

        if($reqkey != $key || $reqtoken != $token){
            $response['status'] = 400;
            $response['message'] = 'token or key mismatch';
            $response['error'] = '';

            //dd($response);
            return json_encode($response);

        }

        return $next($request);
    }
}
