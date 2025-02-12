<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = auth()->user();

        if (!$user) { // Check if user exists after authentication
            return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
        }

        if (!in_array($user->role, $roles)) {
            // Check if $roles is an array before using in_array
            if (is_array($roles) && !empty($roles)) {
                return abort(403, 'Anda tidak memiliki akses.'); // Or redirect as before
            } else {
                return redirect()->route('dashboard')->with('error', 'Role tidak valid.'); // Handle the case where $roles is not an array
            }

        }

        return $next($request);
    }
}