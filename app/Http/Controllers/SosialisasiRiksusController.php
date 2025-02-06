<?php

namespace App\Http\Controllers;

use App\Models\SosialisasiRiksus;
use Illuminate\Http\Request;

class SosialisasiRiksusController extends Controller
{
    public function show($id)
{
    $agenda = SosialisasiRiksus::findOrFail($id);
    return view('agenda.view-sosialisasi-riksus', compact('agenda'));
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

    $agenda = SosialisasiRiksus::findOrFail($id);
    $agenda->update($request->all());

    return redirect()->route('view-sosialisasi-riksus.index')->with('success', 'Agenda Sosialisasi berhasil diperbarui');
}

}
