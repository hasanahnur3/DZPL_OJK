<?php

namespace App\Http\Controllers;

use App\Models\KelembagaanPvml;
use Illuminate\Http\Request;

class KelembagaanPvmlController extends Controller
{
    public function edit($id)
{
    $kelembagaan = KelembagaanPvml::findOrFail($id);
    return view('kelembagaan.edit', compact('kelembagaan'));
}
    public function index()
    {
        $data = KelembagaanPvml::all(); // Tambahkan ini jika ingin menampilkan data
        return view('perizinanpvml.kelembagaan', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_industri' => 'nullable|string|max:33',
            'nama_perusahaan' => 'nullable|string|max:54',
            'detail_izin' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:23', // Sesuaikan dengan nama field di form
            'nomor_surat_permohonan' => 'nullable|string|max:80',
            'tanggal_surat_permohonan' => 'nullable|date',
            'tanggal_pengajuan_sistem' => 'nullable|date',
            'tanggal_dokumen_lengkap' => 'nullable|date',
            'tanggal_selesai_analisis' => 'nullable|date',
            'sla' => 'nullable|integer',
            'nomor_surat' => 'nullable|string|max:11',
            'tanggal_surat' => 'nullable|date',
            'jumlah_hari_kerja' => 'nullable|string|max:17',
            'aksi' => 'nullable|string|max:4',
        ]);

        try {
            KelembagaanPvml::create($validatedData);
            return redirect()->route('kelembagaan.index')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}