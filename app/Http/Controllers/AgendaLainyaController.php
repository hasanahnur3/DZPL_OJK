<?php

namespace App\Http\Controllers;

use App\Models\AgendaLainya;  // Pastikan model AgendaLainya sudah dibuat
use Illuminate\Http\Request;

class AgendaLainyaController extends Controller
{
    // Method untuk menampilkan semua data agenda lainnya
    public function index()
    {
        // Ambil semua data agenda lainnya
        $agendaLainnya = AgendaLainya::all();

        // Kirim data agenda lainnya ke view
        return view('agenda.view-agenda-lainnya', compact('agendaLainnya'));
    }
    public function create()
    {
        return view(view:'agenda.agenda-lainnya');
    }

    // Method untuk menyimpan data agenda lainnya
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'topik' => 'required|string',
            'hasil' => 'required|string',
        ]);

        AgendaLainya::create($request->all());


        return redirect()->route('agenda-lainnya.index')->with('success', 'Agenda lainnya berhasil ditambahkan!');
    }

    // Method untuk menampilkan form edit agenda lainnya
    public function edit($id)
    {
        $agendaLainya = AgendaLainya::findOrFail($id);
        return view('agenda.edit-agenda-lainnya', compact('agendaLainya'));
    }

    // Method untuk memperbarui data agenda lainnya
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'topik' => 'required|string',
            'hasil' => 'required|string',
        ]);

        $agendaLainya = AgendaLainya::findOrFail($id);
        $agendaLainya->update($request->all());

        return redirect()->route('agenda-lainnya.index')->with('success', 'Agenda lainnya berhasil diperbarui!');
    }

    // Method untuk menghapus data agenda lainnya
}
