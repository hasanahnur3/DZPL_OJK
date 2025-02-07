<?php

namespace App\Http\Controllers;

use App\Models\Daftarljk;
use Illuminate\Http\Request;

class DaftarljkController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel kelembagaan
        $ljkList = Daftarljk::all();
        
        return view('daftar-ljk', compact('ljkList'));
    }
}
