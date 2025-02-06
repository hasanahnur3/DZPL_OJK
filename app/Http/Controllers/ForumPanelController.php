<?php

namespace App\Http\Controllers;

use App\Models\ForumPanel;
use Illuminate\Http\Request;

class ForumPanelController extends Controller
{
    public function index()
    {
        $forumPanels = ForumPanel::all();
        return view('agenda.view-forum-panel', compact('forumPanels'));
    }

    public function create()
    {
        return view('agenda.forum-panel'); // Halaman tambah forum panel
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'hari_pelaksanaan' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'tempat_pelaksanaan' => 'required|string|max:255',
            'kriteria' => 'required|string',
            'jenis_industri' => 'required|string|max:255',
            'hasil' => 'required|string',
        ]);

        ForumPanel::create($request->all());
        return redirect()->route('forum-panel.index')->with('success', 'Forum panel added successfully.');
    }

    public function edit($id)
    {
        $forumPanel = ForumPanel::findOrFail($id);
        return view('agenda.edit-forum-panel', compact('forumPanel'));
    }

    public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'nama_perusahaan' => 'required|string|max:255',
        'hari_pelaksanaan' => 'required|date',
        'waktu' => 'required',
        'tempat_pelaksanaan' => 'required|string|max:255',
        'kriteria' => 'required|string',
        'jenis_industri' => 'required|string|max:255',
        'hasil' => 'required|string',
    ]);

    // Cari data berdasarkan ID
    $forumPanel = ForumPanel::findOrFail($id);

    // Update data
    $forumPanel->update([
        'nama_perusahaan' => $request->nama_perusahaan,
        'hari_pelaksanaan' => $request->hari_pelaksanaan,
        'waktu' => $request->waktu,
        'tempat_pelaksanaan' => $request->tempat_pelaksanaan,
        'kriteria' => $request->kriteria,
        'jenis_industri' => $request->jenis_industri,
        'hasil' => $request->hasil,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('forum-panel.index')->with('success', 'Forum Panel berhasil diperbarui.');
}

    public function destroy($id)
    {
        $forumPanel = ForumPanel::findOrFail($id);
        $forumPanel->delete();

        return redirect()->route('forum-panel.index')->with('success', 'Forum panel deleted successfully.');
    }
}
