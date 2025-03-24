<?php

namespace App\Http\Controllers;

use App\Models\Daftarljk;
use Illuminate\Http\Request;
use App\Models\Pkk;
use Illuminate\Support\Facades\DB;

class PkkController extends Controller
{

    public function index(Request $request)
    {
        // Filter default: 1 bulan terakhir
        $startDate = $request->input('start_date', now()->subMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        // Query dengan filter tanggal tanpa relasi
        $data = PKK::whereBetween('tanggal_surat_permohonan', [$startDate, $endDate])->get();

        return view('perizinanpvml.view-pkk', compact('data', 'startDate', 'endDate'));
    }

    // Halaman form tambah data dengan data dari DB
    public function create()
    {
        $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
        return view('perizinanpvml.pkk', compact('jenis_industri'));
    }

    public function getCompaniesByIndustry(Request $request)
    {
        $companies = DB::table('daftarljk')
            ->where('jenis_industri', $request->jenis_industri)
            ->pluck('nama_perusahaan');
        return response()->json($companies);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_industri' => 'required',
            'nama_perusahaan' => 'required',
            'nama_pihak_utama' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'nomor_surat_permohonan' => 'required',
            'tanggal_surat_permohonan' => 'required|date',
            'tanggal_pengajuan_sistem' => 'required|date',
            'tanggal_dok_lengkap' => 'nullable|date', // Perubahan di sini
            'perlu_klarifikasi' => 'required',
            'tanggal_klarifikasi' => 'nullable|date',
            'hasil' => 'required',
            'nomor_persetujuan' => 'required',
            'tanggal_persetujuan' => 'required|date',
        ]);

        Pkk::create($request->all());

        return redirect()->route('pkk')->with('success', 'Data berhasil disimpan');
    }

    // Halaman form edit data
    public function edit($id)
    {
        $data = Pkk::findOrFail($id);
        $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
        $nama_perusahaan = DB::table('daftarljk')
            ->where('jenis_industri', $data->jenis_industri)
            ->pluck('nama_perusahaan');

        return view('perizinanpvml.edit-pkk', compact('data', 'jenis_industri', 'nama_perusahaan'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_industri' => 'required',
            'nama_perusahaan' => 'required',
            'nama_pihak_utama' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'nomor_surat_permohonan' => 'required',
            'tanggal_surat_permohonan' => 'required|date',
            'tanggal_pengajuan_sistem' => 'required|date',
            'tanggal_dok_lengkap' => 'nullable|date', // Perubahan di sini
            'perlu_klarifikasi' => 'required',
            'tanggal_klarifikasi' => 'nullable|date',
            'hasil' => 'required',
            'nomor_persetujuan' => 'required',
            'tanggal_persetujuan' => 'required|date',
        ]);

        $data = Pkk::findOrFail($id);
        $data->update($request->all());

        // Menyimpan siapa yang melakukan update jika pengguna sudah login
        $data->updated_by = session('name');

        // Menyimpan perubahan ke database
        $data->save();

        return redirect()->route('pkk')->with('success', 'Data berhasil diupdate');
    }
    public function show($id)
    {
        return response()->json(Pkk::findOrFail($id));
    }
}
