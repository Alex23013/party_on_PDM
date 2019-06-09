<?php

namespace App\Http\Middleware;

use Closure;
use App\Token;
class TokenMiddleware
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
        $valid = Token::where('token', $request->token)->first();
        if($valid){
           return $next($request); 
        }
        return response()
                ->json(['status' => '403',
                        'message' => 'token de consulta invalido']);
    }
}   