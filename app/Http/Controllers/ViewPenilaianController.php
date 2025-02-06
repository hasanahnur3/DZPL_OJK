<?php

namespace App\Http\Controllers;

use App\Models\ViewPenilaian;
use Illuminate\Http\Request;

class ViewPenilaianController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel ViewPenilaian
        $penilaian = ViewPenilaian::all(); 

        // Kirim data ke view
        return view('perizinanpvml.view-kepengurusan', compact('penilaian'));
    }

    public function create()
    {
        return view('perizinanpvml.kepengurusan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_industri' => 'required',
            'nama_perusahaan' => 'required|string|max:255',
            'nama_pihak_utama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'status' => 'required|string',
            'nomor_surat_permohonan' => 'required|string',
            'tanggal_surat_permohonan' => 'required|date',
            'tanggal_pengajuan_sistem' => 'required|date',
            'tanggal_dok_lengkap' => 'required|date',
            'perlu_klarifikasi' => 'required',
            'tanggal_klarifikasi' => 'nullable|date',
            'hasil' => 'required|string|max:255',
            'nomor_persetujuan' => 'required|string',
            'tanggal_persetujuan' => 'required|date',
            'jumlah_hari_kerja' => 'required|integer',
        ]);

        // Convert perlu_klarifikasi to boolean
        $data = $request->all();
        $data['perlu_klarifikasi'] = $request->perlu_klarifikasi === 'iya' ? 1 : 0;

        ViewPenilaian::create($data);

        return redirect()->route('kepengurusan')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Ambil data berdasarkan ID yang dipilih
        $penilaian = ViewPenilaian::findOrFail($id);
        
        // Tampilkan halaman edit dengan data yang sudah ada
        return view('perizinanpvml.edit-kepengurusan', compact('penilaian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_industri' => 'required',
            'nama_perusahaan' => 'required|string|max:255',
            'nama_pihak_utama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'status' => 'required|string',
            'nomor_surat_permohonan' => 'required|string',
            'tanggal_surat_permohonan' => 'required|date',
            'tanggal_pengajuan_sistem' => 'required|date',
            'tanggal_dok_lengkap' => 'required|date',
            'perlu_klarifikasi' => 'required',
            'tanggal_klarifikasi' => 'nullable|date',
            'hasil' => 'required|string|max:255',
            'nomor_persetujuan' => 'required|string',
            'tanggal_persetujuan' => 'required|date',
            'jumlah_hari_kerja' => 'required|integer',
        ]);

        $data = $request->all();
        $data['perlu_klarifikasi'] = $request->perlu_klarifikasi === 'iya' ? 1 : 0;

        $penilaian = ViewPenilaian::findOrFail($id);
        $penilaian->update($data);

       // Redirect ke halaman sebelumnya dengan pesan sukses
    return redirect()->route('kepengurusan.index')->with('success', 'Data berhasil diperbarui');
    }
}