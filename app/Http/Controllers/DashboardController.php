<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter dari request
        $month = $request->input('month');
        $year = $request->input('year');
        $jenisIndustri = $request->input('jenis_industri');
    
        // Ambil daftar jenis industri unik untuk dropdown
        $jenisIndustriList = DB::table('kelembagaan')
            ->select('jenis_industri')
            ->distinct()
            ->pluck('jenis_industri');
    
        // Query untuk Status Chart
        $statusData = DB::table('kelembagaan')
            ->select('status', DB::raw('count(*) as total'))
            ->when($month, fn($query, $month) => $query->whereMonth('tanggal_pengajuan_sistem', $month))
            ->when($year, fn($query, $year) => $query->whereYear('tanggal_pengajuan_sistem', $year))
            ->when($jenisIndustri, fn($query, $jenisIndustri) => $query->where('jenis_industri', $jenisIndustri))
            ->groupBy('status')
            ->get();
    
        // Query untuk Detail Izin Chart
        $detailIzinData = DB::table('kelembagaan')
            ->select('detail_izin', DB::raw('count(*) as total'))
            ->when($month, fn($query, $month) => $query->whereMonth('tanggal_pengajuan_sistem', $month))
            ->when($year, fn($query, $year) => $query->whereYear('tanggal_pengajuan_sistem', $year))
            ->when($jenisIndustri, fn($query, $jenisIndustri) => $query->where('jenis_industri', $jenisIndustri))
            ->groupBy('detail_izin')
            ->get();
    
        return view('dashboard', [
            'statusData' => $statusData,
            'detailIzinData' => $detailIzinData,
            'selectedMonth' => $month,
            'selectedYear' => $year,
            'jenisIndustriList' => $jenisIndustriList,
            'selectedJenisIndustri' => $jenisIndustri
        ]);
    }
    
}