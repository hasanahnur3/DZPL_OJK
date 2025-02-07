<?php

namespace App\Http\Controllers;

use App\Models\Daftarljk;
use Illuminate\Http\Request;

class DaftarljkController extends Controller
{
    public function index()
    {
        $ljkList = Daftarljk::select('id', 'jenis_industri', 'nama_perusahaan')->get(); // Tambahkan id untuk edit
        return view('daftar-ljk', compact('ljkList'));
    }

    public function edit($id)
    {
        $ljk = Daftarljk::findOrFail($id);
        return view('edit-ljk', compact('ljk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_industri' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
        ]);

        $ljk = Daftarljk::findOrFail($id);
        $ljk->update([
            'jenis_industri' => $request->jenis_industri,
            'nama_perusahaan' => $request->nama_perusahaan,
        ]);

        return redirect()->route('daftarljk.index')->with('success', 'Data berhasil diperbarui!');
    }
}
