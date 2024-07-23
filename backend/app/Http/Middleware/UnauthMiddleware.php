<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UnauthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = explode(' ', $request->header('Authorization'))[1] ?? null;

        if(Auth::guard('sanctum')->check($token)) {
            return response()->json([
                'message' => 'This user is already authenticated'
            ], 403);
        }
        return $next($request);
    }
}
