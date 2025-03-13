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
        $startDate = $request->input('start_date', '');
        $endDate = $request->input('end_date', '');

        // Ambil daftar jenis industri unik untuk dropdown
        $jenisIndustriList = DB::table('kelembagaan')
            ->select('jenis_industri')
            ->distinct()
            ->pluck('jenis_industri');

        // Query untuk Status Chart
        $statusQuery = DB::table('kelembagaan')
            ->select('status', DB::raw('count(*) as total'));

        // Apply date range filter if provided
        if ($startDate && $endDate) {
            $statusQuery->whereBetween('tanggal_pengajuan_sistem', [$startDate, $endDate]);
        } else {
            // Apply individual month/year filters if date range not provided
            if ($selectedMonth) {
                $statusQuery->whereMonth('tanggal_pengajuan_sistem', $selectedMonth);
            }
            if ($selectedYear) {
                $statusQuery->whereYear('tanggal_pengajuan_sistem', $selectedYear);
            }
        }

        // Apply industry filter
        if ($selectedJenisIndustri) {
            $statusQuery->where('jenis_industri', $selectedJenisIndustri);
        }

        $statusData = $statusQuery->groupBy('status')->get();

        // Query untuk Detail Izin Chart dengan pola yang sama
        $detailIzinQuery = DB::table('kelembagaan')
            ->select('detail_izin', DB::raw('count(*) as total'));

        if ($startDate && $endDate) {
            $detailIzinQuery->whereBetween('tanggal_pengajuan_sistem', [$startDate, $endDate]);
        } else {
            if ($selectedMonth) {
                $detailIzinQuery->whereMonth('tanggal_pengajuan_sistem', $selectedMonth);
            }
            if ($selectedYear) {
                $detailIzinQuery->whereYear('tanggal_pengajuan_sistem', $selectedYear);
            }
        }

        if ($selectedJenisIndustri) {
            $detailIzinQuery->where('jenis_industri', $selectedJenisIndustri);
        }

        $detailIzinData = $detailIzinQuery->groupBy('detail_izin')->get();

        // Query untuk frekuensi penguji (perlu dimodifikasi untuk mendukung filter tanggal)
        $dateFilterSQL = "";
        if ($startDate && $endDate) {
            $dateFilterSQL = "AND hari_tanggal BETWEEN '$startDate' AND '$endDate'";
        } else {
            if ($selectedMonth) {
                $dateFilterSQL .= "AND MONTH(hari_tanggal) = $selectedMonth";
            }
            if ($selectedYear) {
                $dateFilterSQL .= "AND YEAR(hari_tanggal) = $selectedYear";
            }
        }

        $pengujiData = DB::table(DB::raw("(SELECT penguji AS nama, COUNT(*) AS total FROM pkk_agendas WHERE 1=1 $dateFilterSQL GROUP BY penguji
            UNION ALL
            SELECT penguji1 AS nama, COUNT(*) AS total FROM pkk_agendas WHERE 1=1 $dateFilterSQL GROUP BY penguji1
            UNION ALL
            SELECT penguji2 AS nama, COUNT(*) AS total FROM pkk_agendas WHERE 1=1 $dateFilterSQL GROUP BY penguji2) AS combined"))
            ->select('nama', DB::raw('SUM(total) as total'))
            ->groupBy('nama')
            ->get();

        // Fetch upcoming agendas from pkk_agendas
        $pkkAgendas = DB::table('pkk_agendas')
            ->select('hari_tanggal as date', DB::raw("'Agenda PKK' as source"))
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

        // Query untuk jenis_industri Chart
        $jenisIndustriQuery = DB::table('pkk')
            ->select('jenis_industri', DB::raw('count(*) as total'));

        if ($startDate && $endDate) {
            $jenisIndustriQuery->whereBetween('tanggal_pengajuan_sistem', [$startDate, $endDate]);
        } else {
            if ($selectedMonth) {
                $jenisIndustriQuery->whereMonth('tanggal_pengajuan_sistem', $selectedMonth);
            }
            if ($selectedYear) {
                $jenisIndustriQuery->whereYear('tanggal_pengajuan_sistem', $selectedYear);
            }
        }

        if ($selectedJenisIndustri) {
            $jenisIndustriQuery->where('jenis_industri', $selectedJenisIndustri);
        }

        $jenisIndustriData = $jenisIndustriQuery->groupBy('jenis_industri')->get();

        // Query untuk status Chart dari tabel pkk
        $statusPenilaianQuery = DB::table('pkk')
            ->select('status', DB::raw('count(*) as total'));

        if ($startDate && $endDate) {
            $statusPenilaianQuery->whereBetween('tanggal_pengajuan_sistem', [$startDate, $endDate]);
        } else {
            if ($selectedMonth) {
                $statusPenilaianQuery->whereMonth('tanggal_pengajuan_sistem', $selectedMonth);
            }
            if ($selectedYear) {
                $statusPenilaianQuery->whereYear('tanggal_pengajuan_sistem', $selectedYear);
            }
        }

        if ($selectedJenisIndustri) {
            $statusPenilaianQuery->where('jenis_industri', $selectedJenisIndustri);
        }

        $statusPenilaianData = $statusPenilaianQuery->groupBy('status')->get();

        // Query untuk hasil Chart dari tabel penilaian
        $hasilQuery = DB::table('pkk')
            ->select('hasil', DB::raw('count(*) as total'));

        if ($startDate && $endDate) {
            $hasilQuery->whereBetween('tanggal_pengajuan_sistem', [$startDate, $endDate]);
        } else {
            if ($selectedMonth) {
                $hasilQuery->whereMonth('tanggal_pengajuan_sistem', $selectedMonth);
            }
            if ($selectedYear) {
                $hasilQuery->whereYear('tanggal_pengajuan_sistem', $selectedYear);
            }
        }

        if ($selectedJenisIndustri) {
            $hasilQuery->where('jenis_industri', $selectedJenisIndustri);
        }

        $hasilData = $hasilQuery->groupBy('hasil')->get();

        // Query untuk Status Perizinan Chart dari tabel tka
        $statusPerizinanQuery = DB::table('tka')
            ->select('status_perizinan', DB::raw('count(*) as total'));

        // Filter berdasarkan tanggal surat permohonan
        if ($startDate && $endDate) {
            $statusPerizinanQuery->whereBetween('tanggal_surat_permohonan', [$startDate, $endDate]);
        } else {
            if ($selectedMonth) {
                $statusPerizinanQuery->whereMonth('tanggal_surat_permohonan', $selectedMonth);
            }
            if ($selectedYear) {
                $statusPerizinanQuery->whereYear('tanggal_surat_permohonan', $selectedYear);
            }
        }

        $statusPerizinanData = $statusPerizinanQuery->groupBy('status_perizinan')->get();

        // Query untuk Jenis Output Chart dari tabel tka
        $jenisOutputQuery = DB::table('tka')
            ->select('jenis_output', DB::raw('count(*) as total'));

        if ($startDate && $endDate) {
            $jenisOutputQuery->whereBetween('tanggal_surat_permohonan', [$startDate, $endDate]);
        } else {
            if ($selectedMonth) {
                $jenisOutputQuery->whereMonth('tanggal_surat_permohonan', $selectedMonth);
            }
            if ($selectedYear) {
                $jenisOutputQuery->whereYear('tanggal_surat_permohonan', $selectedYear);
            }
        }

        $jenisOutputData = $jenisOutputQuery->groupBy('jenis_output')->get();

        // Query untuk Status Perizinan Chart dari tabel dirkom
        $statusPerizinanDirkomQuery = DB::table('dirkom')
            ->select('status_perizinan', DB::raw('count(*) as total'));

        // Filter berdasarkan tanggal surat permohonan
        if ($startDate && $endDate) {
            $statusPerizinanDirkomQuery->whereBetween('tanggal_surat_permohonan', [$startDate, $endDate]);
        } else {
            if ($selectedMonth) {
                $statusPerizinanDirkomQuery->whereMonth('tanggal_surat_permohonan', $selectedMonth);
            }
            if ($selectedYear) {
                $statusPerizinanDirkomQuery->whereYear('tanggal_surat_permohonan', $selectedYear);
            }
        }

        $statusPerizinanDirkomData = $statusPerizinanDirkomQuery->groupBy('status_perizinan')->get();

        // Query untuk Jenis Output Chart dari tabel dirkom
        $jenisOutputDirkomQuery = DB::table('dirkom')
            ->select('jenis_output', DB::raw('count(*) as total'));

        if ($startDate && $endDate) {
            $jenisOutputDirkomQuery->whereBetween('tanggal_surat_permohonan', [$startDate, $endDate]);
        } else {
            if ($selectedMonth) {
                $jenisOutputDirkomQuery->whereMonth('tanggal_surat_permohonan', $selectedMonth);
            }
            if ($selectedYear) {
                $jenisOutputDirkomQuery->whereYear('tanggal_surat_permohonan', $selectedYear);
            }
        }

        $jenisOutputDirkomData = $jenisOutputDirkomQuery->groupBy('jenis_output')->get();


        // Return view with data that has been initialized
        return view('dashboard', compact(
            'statusData',
            'detailIzinData',
            'pengujiData',
            'selectedMonth',
            'selectedYear',
            'jenisIndustriList',
            'selectedJenisIndustri',
            'allAgendas',
            'startDate',
            'endDate',
            'jenisIndustriData',
            'statusPenilaianData',
            'hasilData',
            'statusPerizinanData', // Data status perizinan untuk TKA
            'jenisOutputData',// Data jenis output untuk TKA
            'statusPerizinanDirkomData', // Data status perizinan untuk Dirkom
            'jenisOutputDirkomData'// Data jenis output untuk Dirkom
        ));
    }
}
