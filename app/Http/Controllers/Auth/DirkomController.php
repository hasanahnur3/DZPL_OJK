<?php

namespace App\Http\Controllers;

use App\Models\Dirkom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirkomController extends Controller
{
    public function index()
    {
        $dirkoms = Dirkom::all(); // Ambil semua data Dirkom
        return view('perizinanpvml.view-dirkom', compact('dirkoms'));
    }

    public function create()
    {
        $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
        return view('perizinanpvml.dirkom', compact('jenis_industri'));
    }

    public function getCompaniesByIndustry(Request $request)
    {
        $companies = DB::table('daftarljk')
            ->where('jenis_industri', $request->jenis_industri)
            ->pluck('nama_perusahaan');
        return response()->json($companies);
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
    $jenis_industri = DB::table('daftarljk')->distinct()->pluck('jenis_industri');
    $nama_perusahaan = DB::table('daftarljk')
        ->where('jenis_industri', $dirkom->jenis_industri)
        ->pluck('nama_perusahaan');

    return view('perizinanpvml.edit-dirkom', compact('dirkom', 'jenis_industri', 'nama_perusahaan'));
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
