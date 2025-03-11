<?php

namespace App\Http\Controllers;

use App\Models\Kelembagaan;
use Illuminate\Http\Request;
use App\Models\KelembagaanPvml;
use Illuminate\Support\Facades\DB;

class KelembagaanController extends Controller
{
    // In KelembagaanController.php
    public function index()
    {
        $kelembagaan = KelembagaanPvml::with('izinIndustri')->get();
        return view('perizinanpvml.view-kelembagaan', compact('kelembagaan'));
    }

    public function create()
    {
        $jenis_industri = DB::table('izin_industri')->distinct()->pluck('jenis_industri');
        $detail_izin = []; // Initially empty, will be populated via AJAX

        return view('perizinanpvml.kelembagaan', compact('jenis_industri', 'detail_izin'));
    }


    public function getDetailIzinByIndustry(Request $request)
    {
        $detailIzin = DB::table('izin_industri')
            ->where('jenis_industri', $request->jenis_industri)
            ->pluck('detail_izin');
        return response()->json($detailIzin);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_industri' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'detail_izin' => 'nullable|string',
            'status' => 'required|string|max:50',
            'nomor_surat_permohonan' => 'nullable|string|max:100',
            'tanggal_surat_permohonan' => 'nullable|date',
            'tanggal_pengajuan_sistem' => 'nullable|date',
            'tanggal_dokumen_lengkap' => 'nullable|date',
            'tanggal_selesai_analisis' => 'nullable|date',
            'sla' => 'nullable|integer|min:0',
            'nomor_surat' => 'nullable|string|max:100',
            'tanggal_surat' => 'nullable|date',
            'jumlah_hari_kerja' => 'nullable|integer|min:0',
        ]);

        // Simpan data ke dalam database ojk pada tabel kelembagaan
        $kelembagaan = new Kelembagaan();
        $kelembagaan->fill($validated);
        $kelembagaan->save();

        return redirect()->route('kelembagaan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kelembagaan = KelembagaanPvml::findOrFail($id);
        $jenis_industri = DB::table('izin_industri')->distinct()->pluck('jenis_industri');
        return view('perizinanpvml.edit-kelembagaan', compact('kelembagaan', 'jenis_industri'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis_industri' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'detail_izin' => 'nullable|string',
            'status' => 'required|string|max:50',
            'nomor_surat_permohonan' => 'nullable|string|max:100',
            'tanggal_surat_permohonan' => 'nullable|date',
            'tanggal_pengajuan_sistem' => 'nullable|date',
            'tanggal_dokumen_lengkap' => 'nullable|date',
            'tanggal_selesai_analisis' => 'nullable|date',
            'sla' => 'nullable|integer|min:0',
            'nomor_surat' => 'nullable|string|max:100',
            'tanggal_surat' => 'nullable|date',
            'jumlah_hari_kerja' => 'nullable|integer|min:0',
        ]);

        // Cari data di model KelembagaanPvml
        $kelembagaan = KelembagaanPvml::findOrFail($id);

        // Set 'updated_by' ke nama pengguna yang sedang login
        $kelembagaan->updated_by = session('name'); // Menyimpan nama pengguna yang sedang login

        // Update data
        $kelembagaan->update($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('kelembagaan.index')->with('success', 'Data berhasil diperbarui di kelembagaan_pvml');
    }
}