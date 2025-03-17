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
        // Validasi data
        $request->validate([
            'hari_tanggal' => 'required|date',
            'waktu' => 'required',
            'nama_perusahaan' => 'required|string|max:255',
            'peserta' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'zoom' => 'required|string|max:255',
            'pic' => 'required|string|max:255',
            'penguji' => 'required|string|max:255',
            'penguji1' => 'required|string|max:255',
            'penguji2' => 'required|string|max:255',
            'hasil' => 'required|string',
        ]);

        // Cari data berdasarkan ID
        $agenda = PkkAgenda::find($id);

        // Pastikan data ditemukan
        if (!$agenda) {
            return redirect()->route('pkk-agenda.index')->with('error', 'Data tidak ditemukan.');
        }

        // Update data
        $agenda->update($request->all());

        // Menyimpan siapa yang melakukan update jika pengguna sudah login
        $agenda->updated_by = session('name');

        // Menyimpan perubahan ke database
        $agenda->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('view-penilaian-kemampuan.index')->with('success', 'Data berhasil diperbarui.');
    }




    public function destroy($id)
    {
        $agenda = PkkAgenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('pkk-agenda.index')->with('success', 'Agenda berhasil dihapus');
    }

    public function show($id)
    {
        // Ambil data agenda berdasarkan ID
        $agenda = PKkAgenda::find($id);

        // Periksa apakah data ditemukan
        if (!$agenda) {
            return response()->json([
                'message' => 'Agenda tidak ditemukan.'
            ], 404);
        }

        // Return data dalam format JSON
        return response()->json([
            'id' => $agenda->id,
            'hari_tanggal' => $agenda->hari_tanggal,
            'waktu' => $agenda->waktu,
            'nama_perusahaan' => $agenda->nama_perusahaan,
            'pic' => $agenda->pic,
            'zoom' => $agenda->zoom,
            'peserta' => $agenda->peserta,
            'penguji' => $agenda->penguji,
            'penguji1' => $agenda->penguji1,
            'penguji2' => $agenda->penguji2,
            'hasil' => $agenda->hasil,
            'created_at' => $agenda->created_at->format('d-m-Y H:i'),
            'updated_by' => $agenda->updated_by,
            'updated_at' => $agenda->updated_at ? $agenda->updated_at->format('d-m-Y H:i') : null,
        ]);
    }
}