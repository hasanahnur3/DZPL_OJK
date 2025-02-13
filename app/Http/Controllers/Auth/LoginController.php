<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
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
        'role' => ['required'],
    ]);

    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();

        $user = Auth::user();
        if ($user->role !== $credentials['role']) {
            Auth::logout();
            return back()->withErrors(['role' => 'Peran yang dipilih tidak sesuai dengan akun ini.']);
        }

        return redirect()->route('dashboard'); // Redirect ke dashboard
    }

    return back()->withErrors([
        'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
    ]);
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
