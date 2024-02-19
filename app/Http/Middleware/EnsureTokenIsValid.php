<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EnsureTokenIsValid
 *
 * @package App\Http\Middleware
 */
class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('Api-Key') !== config('app.api_key')) {
            return response()->json(['message' => 'Unauthorized', 'status' => 401], 401);
        }

        return $next($request);
    }
}
