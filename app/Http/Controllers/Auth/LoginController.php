<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); // Guest middleware kecuali logout
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $user = Auth::user();
            switch ($user->role) {
                case 'staf':
                case 'kasubag':
                case 'kabag':
                case 'direktur':
                case 'deputi_direktur':
                case 'kepala_departemen':
                    return redirect()->intended('/dashboard'); // Atau route spesifik untuk role
                    break;
                default:
                    return redirect()->intended('/dashboard'); // Redirect default jika role tidak dikenali
                    break;
            }
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.', // Pesan error dalam bahasa Indonesia
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Tidak perlu lagi method redirectTo di sini
}