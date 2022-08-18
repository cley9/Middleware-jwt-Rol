<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use Illuminate\Http\Request;
// libery
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class TokenValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['status' => 'invalid', 'code' => '400']);
            }
            if ($e instanceof TokenExpiredException) {
                return response()->json(['status' => 'expired token', 'code' => '450']);
            }
            return response()->json(['status' => 'expired token', 'code' => '450']);
        }
        // if (Auth::user()->rol==='usuario') {
        if (Auth::user()->rol === 'administrador') {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
