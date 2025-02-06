<?php

namespace App\Http\Controllers;

use App\Models\Kelembagaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelembagaanController extends Controller
{
    public function edit($id)
    {
        // Menggunakan model Eloquent untuk mencari data
        $kelembagaan = Kelembagaan::find($id); // Ganti ini dengan model yang sesuai

        // Pastikan data ditemukan, jika tidak akan muncul error 404
        if (!$kelembagaan) {
            return redirect()->route('kelembagaan.index')->with('error', 'Data tidak ditemukan');
        }

        return view('perizinanpvml.edit-kelembagaan', compact('kelembagaan'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'status' => 'required',
            'nama_perusahaan' => 'required',
            'detail_izin' => 'required',
            'status_perizinan' => 'required',
            'nomor_surat_permohonan' => 'required',
            'tanggal_surat_permohonan' => 'required|date',
            'tanggal_pengajuan_sistem' => 'required|date',
            'tanggal_dokumen_lengkap' => 'required|date',
            'tanggal_selesai_analisis' => 'required|date',
            'sla' => 'required|numeric',
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'jumlah_hari_kerja' => 'required|numeric',
            'aksi' => 'required'
        ]);

        // Update data di database
        Kelembagaan::where('id', $id)->update($validatedData);

        return redirect()->route('kelembagaan.index')->with('success', 'Data berhasil diperbarui!');
    }
    
    public function index()
    {
        // Fetch all records from the penilaian table
        $penilaian = DB::table('penilaian')->get();
        return view('perizinanpvml.view-kelembagaan', compact('penilaian'));
    }

    public function create()
    {
        return view('perizinanpvml.kelembagaan');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'status' => 'required',
            'nama_perusahaan' => 'required',
            'detail_izin' => 'required',
            'status_perizinan' => 'required',
            'nomor_surat_permohonan' => 'required',
            'tanggal_surat_permohonan' => 'required|date',
            'tanggal_pengajuan_sistem' => 'required|date',
            'tanggal_dokumen_lengkap' => 'required|date',
            'tanggal_selesai_analisis' => 'required|date',
            'sla' => 'required|numeric',
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required|date',
            'jumlah_hari_kerja' => 'required|numeric',
            'aksi' => 'required'
        ]);

        // Insert into database
        DB::table('penilaian')->insert($validatedData);

        return redirect()->route('kelembagaan.index')->with('success', 'Data berhasil ditambahkan!');
    }
}
