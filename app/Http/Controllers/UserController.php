<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function register()
{
    return view('register');
}
    public function __construct()
    {
        // Only kasubag can create users
        $this->middleware('role:create_user')->only(['create', 'store']);
        // Only staff and kasubag can perform CRUD operations
        $this->middleware('role:read')->only(['index', 'show']);
        $this->middleware('role:create')->only(['create', 'store']);
        $this->middleware('role:update')->only(['edit', 'update']);
        $this->middleware('role:delete')->only(['destroy']);
    }

    public function index()
    {
        $users = DB::table('users')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('register'); // Pastikan ini merujuk ke register.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|min:3',
            'role' => 'required|in:staf,kadep,kabag,direktur,deputi,kepala_eksekutif'
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'password' => $request->password, // Hashing password untuk keamanan
            'role' => $request->role,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/dashboard')->with('success', 'User berhasil dibuat!');
    }

    public function edit($id)
    {
        $user = DB::table('users')->find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required|in:staf,kadep,kabag,direktur,deputi'
        ]);

        $updateData = [
            'name' => $request->name,
            'role' => $request->role,
            'updated_at' => now()
        ];

        // Only update password if it's provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('users')
            ->where('id', $id)
            ->update($updateData);

        return redirect('/dashboard')->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect('/dashboard')->with('success', 'User berhasil dihapus!');
    }
}