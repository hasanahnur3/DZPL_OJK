<?php

namespace App\Http\Controllers;

use App\Models\ViewPenilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    // Menambahkan metode index untuk menampilkan data
    public function index()
    {
        // Mengambil data penilaian dari database
        $penilaian = ViewPenilaian::all();

        // Menampilkan halaman view-kepengurusan dan mengirimkan data penilaian
        return view('perizinanpvml.view-kepengurusan', compact('penilaian'));
    }

    // Menambahkan metode create untuk menampilkan form tambah data
    public function create()
    {
        // Menampilkan form untuk tambah data
        return view('perizinanpvml.kepengurusan');
    }

    // Menambahkan metode store untuk menyimpan data baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jenis_industri' => 'required',
            'nama_perusahaan' => 'required',
            'nama_pihak_utama' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'nomor_surat_permohonan' => 'required',
            'tanggal_surat_permohonan' => 'required|date',
            'tanggal_pengajuan_sistem' => 'required|date',
            'tanggal_dok_lengkap' => 'required|date',
            'perlu_klarifikasi' => 'required',
            'tanggal_klarifikasi' => 'nullable|date',
            'hasil' => 'required',
            'nomor_persetujuan' => 'required',
            'tanggal_persetujuan' => 'required|date',
            'jumlah_hari_kerja' => 'required|numeric',
        ]);

        // Menyimpan data ke dalam database
        ViewPenilaian::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('kepengurusan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Menambahkan metode untuk menampilkan form edit
    public function edit($id)
    {
        $penilaian = ViewPenilaian::findOrFail($id);
        return view('edit-kepengurusan', compact('penilaian'));
    }

    // Menambahkan metode untuk update data
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'jenis_industri' => 'required',
            'nama_perusahaan' => 'required',
            'nama_pihak_utama' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'nomor_surat_permohonan' => 'required',
            'tanggal_surat_permohonan' => 'required|date',
            'tanggal_pengajuan_sistem' => 'required|date',
            'tanggal_dok_lengkap' => 'required|date',
            'perlu_klarifikasi' => 'required',
            'tanggal_klarifikasi' => 'nullable|date',
            'hasil' => 'required',
            'nomor_persetujuan' => 'required',
            'tanggal_persetujuan' => 'required|date',
            'jumlah_hari_kerja' => 'required|numeric',
        ]);

        // Menemukan data yang akan diupdate
        $penilaian = ViewPenilaian::findOrFail($id);
        $penilaian->update($validated);

        // Mengarahkan kembali ke halaman dengan pesan sukses
        return redirect()->route('kepengurusan.index')->with('success', 'Data berhasil diupdate');
    }

    // Menambahkan metode untuk menghapus data
    public function destroy($id)
    {
        // Menemukan data yang akan dihapus
        $penilaian = ViewPenilaian::findOrFail($id);
        $penilaian->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('kepengurusan')->with('success', 'Data berhasil dihapus');
    }
}
