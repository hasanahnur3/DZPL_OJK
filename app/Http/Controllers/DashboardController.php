<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Inisialisasi variabel dengan nilai default
        $selectedMonth = $request->input('month', '');
        $selectedYear = $request->input('year', date('Y'));
        $selectedJenisIndustri = $request->input('jenis_industri', '');

        // Ambil daftar jenis industri unik untuk dropdown
        $jenisIndustriList = DB::table('kelembagaan_pvml')
            ->select('jenis_industri')
            ->distinct()
            ->pluck('jenis_industri');

        // Query untuk Status Chart
        $statusData = DB::table('kelembagaan_pvml')
            ->select('status', DB::raw('count(*) as total'))
            ->when($selectedMonth, function ($query, $month) {
                return $query->whereMonth('tanggal_pengajuan_sistem', $month);
            })
            ->when($selectedYear, function ($query, $year) {
                return $query->whereYear('tanggal_pengajuan_sistem', $year);
            })
            ->when($selectedJenisIndustri, function ($query, $jenisIndustri) {
                return $query->where('jenis_industri', $jenisIndustri);
            })
            ->groupBy('status')
            ->get();

        // Query untuk Detail Izin Chart
        $detailIzinData = DB::table('kelembagaan_pvml')
            ->select('detail_izin', DB::raw('count(*) as total'))
            ->when($selectedMonth, function ($query, $month) {
                return $query->whereMonth('tanggal_pengajuan_sistem', $month);
            })
            ->when($selectedYear, function ($query, $year) {
                return $query->whereYear('tanggal_pengajuan_sistem', $year);
            })
            ->when($selectedJenisIndustri, function ($query, $jenisIndustri) {
                return $query->where('jenis_industri', $jenisIndustri);
            })
            ->groupBy('detail_izin')
            ->get();

        // Return view dengan data yang sudah diinisialisasi
        return view('dashboard', compact(
            'statusData',
            'detailIzinData',
            'selectedMonth',
            'selectedYear',
            'jenisIndustriList',
            'selectedJenisIndustri'
        ));
    }
}