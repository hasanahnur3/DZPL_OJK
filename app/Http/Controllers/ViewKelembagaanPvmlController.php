<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelembagaanPvml;

class ViewKelembagaanPvmlController extends Controller
{

    public function create()
    {
        return view('perizinanpvml.view-kelembagaan-create');
    }
    // Menampilkan data
    public function index()
    {
        $kelembagaan = KelembagaanPvml::all();
        return view('perizinanpvml.view-kelembagaan', compact('kelembagaan'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
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

        KelembagaanPvml::create($request->all());

        return redirect()->route('view-kelembagaan.index')->with('success', 'Data berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
{
    $kelembagaan = KelembagaanPvml::findOrFail($id);
    return view('perizinanpvml.edit-kelembagaan', compact('kelembagaan'));
}

    // Update data
    public function update(Request $request, $id)
{
    $request->validate([
        'jenis_industri' => 'nullable|string|max:33',
        'nama_perusahaan' => 'nullable|string|max:54',
        'detail_izin' => 'nullable|string|max:255',
        'status' => 'nullable|string|max:23',
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

    $kelembagaan = KelembagaanPvml::findOrFail($id);
    $kelembagaan->update($request->all());

    return redirect()->route('view-kelembagaan.index')->with('success', 'Data berhasil diperbarui');
}
}
