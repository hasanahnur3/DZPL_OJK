<?php

namespace App\Http\Controllers;

use App\Models\Tka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\TkaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class TkaController extends Controller
{
    // Menampilkan daftar TKA
    public function index(Request $request)
    {
        // Filter default: 1 bulan terakhir
        $startDate = $request->input('start_date', now()->subMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        // Query dengan filter tanggal tanpa relasi
        $tkas = Tka::whereBetween('tanggal_surat_permohonan', [$startDate, $endDate])->get();

        return view('perizinanpvml.view-tka', compact('tkas', 'startDate', 'endDate'));
    }


    // Menampilkan form tambah data
    public function create()
    {
        $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
        return view('perizinanpvml.tka', compact('jenis_industri'));
    }

    public function getCompaniesByIndustry(Request $request)
    {
        $companies = DB::table('daftarljk')
            ->where('jenis_industri', $request->jenis_industri)
            ->pluck('nama_perusahaan');
        return response()->json($companies);
    }

    // Menyimpan data
    public function store(Request $request)
    {
        $request->validate([
            'jenis_industri' => 'required|string',
            'nama_perusahaan' => 'required|string',
            'nomor_surat_permohonan' => 'required|string',
            'tanggal_surat_permohonan' => 'required|date',
            'status_perizinan' => 'required|in:Dalam proses analisis,Kelengkapan dok,Selesai,Ditolak/Dikembalikan',
            'jenis_output' => 'required|in:pencatatan,penolakan',
            'tanggal_dok_lengkap' => 'nullable|date',
            'no_surat_pencatatan' => 'nullable|string',
            'tanggal_surat_pencatatan' => 'nullable|date',
        ]);

        Tka::create($request->all());

        return redirect()->route('tka.index')->with('success', 'Data berhasil disimpan');
    }

    // Menampilkan form edit data

    public function edit($id)
    {
        $tka = Tka::findOrFail($id);
        $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
        $nama_perusahaan = DB::table('daftarljk')
            ->where('jenis_industri', $tka->jenis_industri)
            ->pluck('nama_perusahaan');

        return view('perizinanpvml.edit-tka', compact('tka', 'jenis_industri', 'nama_perusahaan'));
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_industri' => 'required|string',
            'nama_perusahaan' => 'required|string',
            'nomor_surat_permohonan' => 'required|string',
            'tanggal_surat_permohonan' => 'required|date',
            'status_perizinan' => 'required|in:Dalam proses analisis,Kelengkapan dok,Selesai,Ditolak/Dikembalikan',
            'jenis_output' => 'required|in:pencatatan,penolakan',
            'tanggal_dok_lengkap' => 'nullable|date',
            'no_surat_pencatatan' => 'nullable|string',
            'tanggal_surat_pencatatan' => 'nullable|date',
        ]);

        $tka = Tka::findOrFail($id);
        $tka->update($request->all());

        $tka->updated_by = session('name');  // Menyimpan nama pengguna yang sedang login

        // Menyimpan perubahan ke database
        $tka->save();

        return redirect()->route('tka')->with('success', 'Data berhasil diperbarui');
    }

    public function show($id)
    {
        return response()->json(Tka::findOrFail($id));
    }

    public function export(Request $request)
    {
        Log::info('Export called with:', $request->all()); // Log parameter yang diterima
    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        if (!$startDate || !$endDate) {
            return response()->json(['message' => 'Tanggal tidak lengkap'], 400); // Tambahkan validasi tanggal
        }
    
        return Excel::download(new TkaExport($startDate, $endDate), 'tka_data.xlsx');
    }
}
