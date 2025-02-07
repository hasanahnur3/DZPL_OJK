<?php

namespace App\Http\Controllers;

use App\Models\Kelembagaan;
use Illuminate\Http\Request;
use App\Models\KelembagaanPvml;

class KelembagaanController extends Controller
{
    public function index()
    {
        $kelembagaan = KelembagaanPvml::all(); // Mengambil semua data dari tabel kelembagaan_pvml
        return view('perizinanpvml.view-kelembagaan', compact('kelembagaan'));
    }

    public function create()
    {
        return view('perizinanpvml.kelembagaan');
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
        $kelembagaan = KelembagaanPvml::findOrFail($id); // Gunakan model KelembagaanPvml
        return view('perizinanpvml.edit-kelembagaan', compact('kelembagaan'));
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
        'aksi' => 'nullable|string|max:255',
    ]);

    // Cari data di model KelembagaanPvml (bukan Kelembagaan)
    $kelembagaan = KelembagaanPvml::findOrFail($id);
    $kelembagaan->update($validated);
    
    return redirect()->route('kelembagaan.index')->with('success', 'Data berhasil diperbarui di kelembagaan_pvml');
}

}