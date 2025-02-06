<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pkk;

class PkkController extends Controller
{
    public function index()
    {
        $data = Pkk::all(); // Ambil semua data dari tabel pkk
        return view('perizinanpvml.view-pkk', compact('data'));
    }

    // Halaman form tambah data
    public function create()
    {
        return view('perizinanpvml.pkk');
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
            'tanggal_dok_lengkap' => 'required|date',
            'perlu_klarifikasi' => 'required',
            'tanggal_klarifikasi' => 'nullable|date',
            'hasil' => 'required',
            'tanggal_sk' => 'nullable|date',
            'nomor_persetujuan' => 'required',
            'tanggal_persetujuan' => 'required|date',
            'jumlah_hari_kerja' => 'required|integer',
        ]);

        Pkk::create($request->all());

        return redirect()->route('pkk')->with('success', 'Data berhasil disimpan');
    }

    // Halaman form edit data
    public function edit($id)
    {
        $data = Pkk::findOrFail($id);
        return view('perizinanpvml.edit-pkk', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            // Validation rules here (similar to store method)
        ]);

        $data = Pkk::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('pkk')->with('success', 'Data berhasil diupdate');
    }
}
