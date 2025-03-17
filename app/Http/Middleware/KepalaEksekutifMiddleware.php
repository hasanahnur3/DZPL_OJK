<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KepalaEksekutifMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'kepala_eksekutif') {
            return $next($request);
        }
    
        abort(403, 'Unauthorized access.');
    }
}
