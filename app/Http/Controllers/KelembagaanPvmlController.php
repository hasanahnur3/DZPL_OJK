<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelembagaanPvml;
use Carbon\Carbon;

class KelembagaanPvmlController extends Controller
{
    public function index()
    {
        try {
            // Mengambil data dari database "ojk"
            $kelembagaan = KelembagaanPvml::on('ojk')->orderBy('created_at', 'desc')->get();
            return view('perizinanpvml.view-kelembagaan', compact('kelembagaan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data');
        }
    }

    public function create()
    {
        return view('perizinanpvml.kelembagaan');
    }

    public function store(Request $request)
    {
        try {
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

            // Menyimpan data ke database "ojk"
            KelembagaanPvml::on('ojk')->create($validated);
            return redirect()->route('kelembagaan.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data')->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $kelembagaan = KelembagaanPvml::on('ojk')->findOrFail($id);
            return view('perizinanpvml.edit-kelembagaan', compact('kelembagaan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        try {
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

            $kelembagaan = KelembagaanPvml::on('ojk')->findOrFail($id);
            $kelembagaan->update($validated);
            
            return redirect()->route('kelembagaan.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data')->withInput();
        }
    }
}
