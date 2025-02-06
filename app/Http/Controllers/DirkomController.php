<?php

namespace App\Http\Controllers;

use App\Models\Dirkom;
use Illuminate\Http\Request;

class DirkomController extends Controller
{
    public function index()
    {
        $dirkoms = Dirkom::all(); // Ambil semua data Dirkom
        return view('perizinanpvml.view-dirkom', compact('dirkoms'));
    }

    public function create()
    {
        return view('perizinanpvml.dirkom');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_industri' => 'required',
            'nama_perusahaan' => 'required',
            'nomor_surat_permohonan' => 'required',
            'tanggal_surat_permohonan' => 'required|date',
            'status_perizinan' => 'required',
            'jenis_output' => 'required',
            'tanggal_dok_lengkap' => 'nullable|date',
            'nomor_surat_pencatatan' => 'nullable',
            'tanggal_surat_pencatatan' => 'nullable|date',
        ]);

        Dirkom::create($validated);

        return redirect()->route('dirkom.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $dirkom = Dirkom::findOrFail($id);
        return view('perizinanpvml.edit-dirkom', compact('dirkom'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis_industri' => 'required',
            'nama_perusahaan' => 'required',
            'nomor_surat_permohonan' => 'required',
            'tanggal_surat_permohonan' => 'required|date',
            'status_perizinan' => 'required',
            'jenis_output' => 'required',
            'tanggal_dok_lengkap' => 'nullable|date',
            'nomor_surat_pencatatan' => 'nullable',
            'tanggal_surat_pencatatan' => 'nullable|date',
        ]);

        $dirkom = Dirkom::findOrFail($id);
        $dirkom->update($validated);

        return redirect()->route('dirkom.index')
            ->with('success', 'Data berhasil diperbarui');
    }
}
