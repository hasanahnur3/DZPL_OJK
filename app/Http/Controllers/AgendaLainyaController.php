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

        $agendaLainya->updated_by = session('name');  // Menyimpan nama pengguna yang sedang login
    
        // Menyimpan perubahan ke database
        $agendaLainya->save();

        return redirect()->route('agenda-lainnya.index')->with('success', 'Agenda lainnya berhasil diperbarui!');
    }

    public function show($id)
    {
        // Ambil data agenda berdasarkan ID
        $agendaLainya = AgendaLainya::find($id);

        // Periksa apakah data ditemukan
        if (!$agendaLainya) {
            return response()->json([
                'message' => 'Agenda tidak ditemukan.'
            ], 404);
        }

        // Return data dalam format JSON
        return response()->json([
            'id' => $agendaLainya->id,
            'tanggal' => $agendaLainya->tanggal,
            'topik' => $agendaLainya->topik,
            'hasil' => $agendaLainya->hasil,
            'created_at' => $agendaLainya->created_at->format('d-m-Y H:i'),
            'updated_by' => $agendaLainya->updated_by,
            'updated_at' => $agendaLainya->updated_at ? $agendaLainya->updated_at->format('d-m-Y H:i') : null,
        ]);
    }
}
