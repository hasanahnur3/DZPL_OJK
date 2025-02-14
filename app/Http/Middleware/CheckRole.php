<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckRole
{
    protected $permissions = [
        'staf' => ['create', 'read', 'update', 'delete'],
        'kasubag' => ['create', 'read', 'update', 'delete', 'create_user'],
        'kabag' => ['read'],
        'direktur' => ['read'],
        'deputi' => ['read'],
        'kadep' => ['read']
    ];

    public function handle(Request $request, Closure $next, $permission = null)
    {
        if (!Session::has('user_id')) {
            return redirect('/login')->withErrors(['access' => 'Silakan login terlebih dahulu.']);
        }

        $userRole = Session::get('role');
        
        // If specific permission is required
        if ($permission) {
            if (!in_array($permission, $this->permissions[$userRole] ?? [])) {
                return redirect('/dashboard')->withErrors(['access' => 'Anda tidak memiliki izin untuk mengakses halaman ini.']);
            }
        }

        // Add permissions to request for use in views/controllers
        $request->merge(['user_permissions' => $this->permissions[$userRole] ?? []]);

        return $next($request);
    }
}