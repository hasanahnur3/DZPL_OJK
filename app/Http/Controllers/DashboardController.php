<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ✅ Tambahkan ini

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard'); // Mengembalikan tampilan 'dashboard.blade.php'
    }
    

    public function getChartData()
    {
        $data = DB::table('kelembagaan')
            ->select('jenis_industri', DB::raw('COUNT(nama_perusahaan) as total'))
            ->groupBy('jenis_industri')
            ->get();

        return response()->json($data);
    }
}
