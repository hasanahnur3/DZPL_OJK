<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data default (1 bulan terakhir)
        $statusData = $this->getStatusData(Carbon::now()->subMonth());
        $detailIzinData = $this->getDetailIzinData(Carbon::now()->subMonth());

        return view('dashboard', [
            'statusData' => $statusData,
            'detailIzinData' => $detailIzinData
        ]);
    }

    public function getChartData(Request $request)
    {
        $filter = $request->query('filter', '1_month'); // Default: 1 bulan terakhir
        $startDate = $this->getStartDateFromFilter($filter);

        // Ambil data berdasarkan tanggal_pengajuan_sistem
        $statusData = $this->getStatusData($startDate);
        $detailIzinData = $this->getDetailIzinData($startDate);

        return response()->json([
            'statusData' => $statusData,
            'detailIzinData' => $detailIzinData,
        ]);
    }

    private function getStatusData($startDate)
    {
        return DB::table('kelembagaan')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->where('tanggal_pengajuan_sistem', '>=', $startDate)
            ->groupBy('status')
            ->get();
    }

    private function getDetailIzinData($startDate)
    {
        return DB::table('kelembagaan')
            ->select('detail_izin', DB::raw('COUNT(*) as total'))
            ->where('tanggal_pengajuan_sistem', '>=', $startDate)
            ->groupBy('detail_izin')
            ->get();
    }

    private function getStartDateFromFilter($filter)
    {
        switch ($filter) {
            case '3_months':
                return Carbon::now()->subMonths(3);
            case '6_months':
                return Carbon::now()->subMonths(6);
            case '1_year':
                return Carbon::now()->subYear();
            default:
                return Carbon::now()->subMonth(); // Default 1 bulan terakhir
        }
    }
}
