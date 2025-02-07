<?php

namespace App\Http\Controllers;

use App\Models\PkkAgenda;
use Illuminate\Http\Request;

class PkkAgendaController extends Controller
{
    public function index()
    {
        $agendas = PkkAgenda::all(); // Menampilkan data agenda
        return view('agenda.penilaian-kemampuan', compact('agendas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari_tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'nama_perusahaan' => 'required|string',
            'peserta' => 'required|string',
            'jabatan' => 'required|string',
            'zoom' => 'required|string',
            'pic' => 'required|string',
            'penguji' => 'required|string',
            'penguji1' => 'required|string',  // Pastikan penguji1 ada dan tidak kosong
            'penguji2' => 'nullable|string',  // Penguji2 bisa kosong
            'hasil' => 'required|string',
        ]);

        PkkAgenda::create($request->all());

        return redirect()->route('pkk-agenda.index')->with('success', 'Agenda berhasil ditambahkan');
    }

    public function edit($id)
    {
        $agenda = PkkAgenda::findOrFail($id);
        return view('agenda.edit-pkk', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari_tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'nama_perusahaan' => 'required|string',
            'peserta' => 'required|string',
            'jabatan' => 'required|string',
            'zoom' => 'required|string',
            'pic' => 'required|string',
            'penguji' => 'required|string',
            'penguji1' => 'required|string',  // Pastikan penguji1 ada dan tidak kosong
            'penguji2' => 'nullable|string',  // Penguji2 bisa kosong
            'hasil' => 'required|string',
        ]);
    
        $agenda = PkkAgenda::findOrFail($id);
        $agenda->update($request->all());
    
        return redirect()->route('pkk-agenda.index')->with('success', 'Agenda berhasil diperbarui');
    }
    

    public function destroy($id)
    {
        $agenda = PkkAgenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('pkk-agenda.index')->with('success', 'Agenda berhasil dihapus');
    }
}
