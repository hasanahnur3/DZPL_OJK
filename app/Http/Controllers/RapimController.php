<?php

// File: app/Http/Controllers/RapimController.php

namespace App\Http\Controllers;

use App\Models\Rapim;
use Illuminate\Http\Request;

class RapimController extends Controller
{
    public function index()
    {
        $rapim = Rapim::all();  // Ambil semua data rapat
        return view('agenda.view-rapat-pimpinan', compact('rapim'));  // Kirim ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'topik' => 'required|string',
            'hasil' => 'required|string',
        ]);

        Rapim::create($request->all());

        return redirect()->route('rapim.index')->with('success', 'Agenda rapat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $rapim = Rapim::findOrFail($id);  // Mencari rapim berdasarkan ID
        return view('agenda.edit-rapim', compact('rapim'));
    }

    // Method untuk memproses update data rapim
    // Method untuk memproses update data rapim
    public function update(Request $request, $id)
    {
        // Validasi inputan
        $request->validate([
            'tanggal' => 'required|date',
            'topik' => 'required|string',
            'hasil' => 'required|string',
        ]);
    
        // Mencari data rapim berdasarkan ID
        $rapim = Rapim::findOrFail($id);
    
        // Melakukan update pada data rapim
        $rapim->update([
            'tanggal' => $request->tanggal,
            'topik' => $request->topik,
            'hasil' => $request->hasil,
        ]);
    
        // Mengarahkan kembali ke halaman view rapat pimpinan dengan pesan sukses
        return redirect()->route('view-rapat-pimpinan.index')->with('success', 'Agenda rapat berhasil diperbarui!');
    }
    


    public function destroy($id)
    {
        $rapim = Rapim::findOrFail($id);
        $rapim->delete();

        return redirect()->route('rapim.index')->with('success', 'Agenda rapat berhasil dihapus!');
    }
}
