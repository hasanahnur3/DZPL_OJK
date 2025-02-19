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
        $jenisIndustriList = DB::table('kelembagaan')
            ->select('jenis_industri')
            ->distinct()
            ->pluck('jenis_industri');
    
        // Query untuk Status Chart
        $statusData = DB::table('kelembagaan')
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
        $detailIzinData = DB::table('kelembagaan')
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
    
        // Query untuk frekuensi penguji
        $pengujiData = DB::table(DB::raw("(SELECT penguji AS nama, COUNT(*) AS total FROM pkk_agendas WHERE 1=1
            " . ($selectedMonth ? "AND MONTH(hari_tanggal) = $selectedMonth" : "") . "
            " . ($selectedYear ? "AND YEAR(hari_tanggal) = $selectedYear" : "") . "
            GROUP BY penguji
            UNION ALL
            SELECT penguji1 AS nama, COUNT(*) AS total FROM pkk_agendas WHERE 1=1
            " . ($selectedMonth ? "AND MONTH(hari_tanggal) = $selectedMonth" : "") . "
            " . ($selectedYear ? "AND YEAR(hari_tanggal) = $selectedYear" : "") . "
            GROUP BY penguji1
            UNION ALL
            SELECT penguji2 AS nama, COUNT(*) AS total FROM pkk_agendas WHERE 1=1
            " . ($selectedMonth ? "AND MONTH(hari_tanggal) = $selectedMonth" : "") . "
            " . ($selectedYear ? "AND YEAR(hari_tanggal) = $selectedYear" : "") . "
            GROUP BY penguji2) AS combined"))
            ->select('nama', DB::raw('SUM(total) as total'))
            ->groupBy('nama')
            ->get();
    
        // Fetch upcoming agendas from pkk_agendas
        $pkkAgendas = DB::table('pkk_agendas')
            ->select('hari_tanggal as date', DB::raw("'PKK' as source"))
            ->where('hari_tanggal', '>=', now())
            ->get();
    
        // Fetch upcoming agendas from rapim
        $rapimAgendas = DB::table('rapim')
            ->select('tanggal as date', DB::raw("'RAPIM' as source"))
            ->where('tanggal', '>=', now())
            ->get();
    
        // Fetch upcoming agendas from riksus
        $riksusAgendas = DB::table('sosialisasi_riksus')
            ->select('hari_tanggal as date', DB::raw("'RIKSUS' as source"))
            ->where('hari_tanggal', '>=', now())
            ->get();
    
        // Fetch upcoming agendas from forum_panels
        $forumPanelsAgendas = DB::table('forum_panels')
            ->select('hari_pelaksanaan as date', DB::raw("'FORUM PANEL' as source"))
            ->where('hari_pelaksanaan', '>=', now())
            ->get();
    
        // Merge all agendas into a single collection
        $allAgendas = $pkkAgendas->merge($rapimAgendas)->merge($riksusAgendas)->merge($forumPanelsAgendas);
    
        // Sort agendas by date
        $allAgendas = $allAgendas->sortBy('date');
    
        // Return view with data that has been initialized
        return view('dashboard', compact(
            'statusData',
            'detailIzinData',
            'pengujiData',
            'selectedMonth',
            'selectedYear',
            'jenisIndustriList',
            'selectedJenisIndustri',
            'allAgendas'
        ));
    }
    
}