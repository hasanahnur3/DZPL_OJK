<?php

namespace App\Http\Controllers;

use App\Models\Daftarljk;
use Illuminate\Http\Request;

class DaftarljkController extends Controller
{
    public function index()
    {
        // Ambil data dari tabel kelembagaan
        $kelembagaan = Daftarljk::all();
        
        // Kirim data ke view daftar-ljk
        return view('daftar-ljk', compact('kelembagaan'));
    }
}
