<?php

// File: app/Http/Controllers/RapimController.php

namespace App\Http\Controllers;

use App\Models\Rapim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RapimController extends Controller
{
    public function index()
    {
        $rapim = Rapim::all();  // Ambil semua data rapat
        return view('agenda.view-rapat-pimpinan', compact('rapim'));  // Kirim ke view
    }

    public function store(Request $request)
    {
        // Validasi input, termasuk file
        $request->validate([
            'tanggal' => 'required|date',
            'topik' => 'required|string|max:255',
            'bahan_materi' => 'required|file|mimes:pdf,ppt,pptx|max:10240', // 10MB Max untuk bahan materi
            'hasil' => 'required|file|mimes:pdf,ppt,pptx|max:10240', // 10MB Max
        ]);

        // Menyimpan file Bahan Materi ke dalam storage dan mendapatkan path-nya
        $bahanMateriPath = $request->file('bahan_materi')->store('rapim_files', 'public');

        // Menyimpan file ke dalam storage dan mendapatkan path-nya
        $hasilPath = $request->file('hasil')->store('rapim_files', 'public');// Menyimpan di storage/app/public/rapim_files

        // Menyimpan data rapim ke dalam database
        Rapim::create([
            'tanggal' => $request->tanggal,
            'topik' => $request->topik,
            'bahan_materi' => $bahanMateriPath,
            'hasil' => $hasilPath, // Menyimpan path file
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('rapim.index')->with('success', 'Agenda rapat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $rapim = Rapim::findOrFail($id);
        return view('agenda.edit-rapim', compact('rapim'));
    }


    // Method untuk memproses update data rapim
    // Method untuk memproses update data rapim
    public function update(Request $request, $id)
    {
        // Temukan data rapim berdasarkan ID
        $rapim = Rapim::findOrFail($id);

        // Validasi input dari form
        $request->validate([
            'tanggal' => 'required|date',
            'topik' => 'required|string|max:255',
            'bahan_materi' => 'nullable|file|mimes:pdf,ppt,pptx', // Validasi untuk file bahan materi
            'hasil' => 'nullable|file|mimes:pdf,ppt,pptx', // Validasi untuk file hasil
        ]);

        // Update file bahan_materi jika ada
        if ($request->hasFile('bahan_materi')) {
            // Menghapus file lama jika ada
            if ($rapim->bahan_materi) {
                Storage::delete($rapim->bahan_materi);
            }

            // Menyimpan file baru dan menyimpan pathnya
            $bahanMateriPath = $request->file('bahan_materi')->store('bahan_materi');
            $rapim->bahan_materi = $bahanMateriPath;
        }

        // Update file hasil jika ada
        if ($request->hasFile('hasil')) {
            // Menghapus file lama jika ada
            if ($rapim->hasil) {
                Storage::delete($rapim->hasil);
            }

            // Menyimpan file baru dan menyimpan pathnya
            $hasilPath = $request->file('hasil')->store('hasil');
            $rapim->hasil = $hasilPath;
        }

        // Menyimpan data yang diupdate
        // Menyimpan siapa yang melakukan update jika pengguna sudah login
        $rapim->updated_by = session('name');

        
        // Mengupdate tanggal dan topik
        $rapim->tanggal = $request->tanggal;
        $rapim->topik = $request->topik;

        // Menyimpan perubahan ke database
        $rapim->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('rapim.index')->with('success', 'Data berhasil diupdate.');
    }



    public function destroy($id)
    {
        $rapim = Rapim::findOrFail($id);
        $rapim->delete();

        return redirect()->route('rapim.index')->with('success', 'Agenda rapat berhasil dihapus!');
    }
}
