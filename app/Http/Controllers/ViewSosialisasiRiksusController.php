<?php

// app/Http/Controllers/SosialisasiRiksusController.php

namespace App\Http\Controllers;

use App\Models\SosialisasiRiksus;

class ViewSosialisasiRiksusController extends Controller
{
    public function index()
    {
        $data = SosialisasiRiksus::all(); // Ambil semua data dari tabel
        return view('agenda.view-sosialisasi-riksus', compact('data')); // Kirim data ke view
    }
}
