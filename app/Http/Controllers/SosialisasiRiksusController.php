<?php

namespace App\Http\Controllers;

use App\Models\SosialisasiRiksus;
use Illuminate\Http\Request;

class SosialisasiRiksusController extends Controller
{
    public function show($id)
    {
        $agenda = SosialisasiRiksus::find($id);

        if (!$agenda) {
            return response()->json([
                'message' => 'Agenda tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'id' => $agenda->id,
            'judul_sosialisasi' => $agenda->judul_sosialisasi,
            'hari_tanggal' => $agenda->hari_tanggal,
            'tempat' => $agenda->tempat,
            'keterangan_peserta' => $agenda->keterangan_peserta,
            'kesimpulan' => $agenda->kesimpulan,
            'created_at' => $agenda->created_at->format('d-m-Y H:i'),
            'updated_by' => $agenda->updated_by,
            'updated_at' => $agenda->updated_at ? $agenda->updated_at->format('d-m-Y H:i') : null,
        ]);
    }

    // Menampilkan form dengan data
    public function index()
    {
        $sosialisasiRiksus = SosialisasiRiksus::all();
        return view('agenda.sosialisasi-riksus', compact('sosialisasiRiksus'));
    }

    // Menyimpan data agenda baru
    public function store(Request $request)
    {
        $request->validate([
            'judul_sosialisasi' => 'required',
            'hari_tanggal' => 'required|date',
            'tempat' => 'required',
            'keterangan_peserta' => 'required',
            'kesimpulan' => 'required',
        ]);

        SosialisasiRiksus::create($request->all());

        return redirect()->route('view-sosialisasi-riksus.index')->with('success', 'Agenda Sosialisasi berhasil ditambahkan');
    }

    // Menghapus agenda
    public function destroy($id)
    {
        $agenda = SosialisasiRiksus::findOrFail($id);
        $agenda->delete();

        return redirect()->route('sosialisasi-riksus.index')->with('success', 'Agenda Sosialisasi berhasil dihapus');
    }

    // Menampilkan data untuk edit
    public function edit($id)
    {
        $agenda = SosialisasiRiksus::findOrFail($id);
        return view('agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_sosialisasi' => 'required',
            'hari_tanggal' => 'required|date',
            'tempat' => 'required',
            'keterangan_peserta' => 'required',
            'kesimpulan' => 'required',
        ]);
        // Temukan data sosialisasi_riksus berdasarkan ID
        $agenda = SosialisasiRiksus::findOrFail($id);

        // Menyimpan siapa yang melakukan update
        $agenda->updated_by = session('name');

        // Menyimpan perubahan ke database

        $agenda->update($request->all());
        $agenda->save();

        return redirect()->route('view-sosialisasi-riksus.index')->with('success', 'Agenda Sosialisasi berhasil diperbarui');
    }

}
