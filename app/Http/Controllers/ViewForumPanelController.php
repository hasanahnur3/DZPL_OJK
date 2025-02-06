<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewForumPanel;

class ViewForumPanelController extends Controller
{
    public function edit($id)
    {
        $forumPanel = ViewForumPanel::findOrFail($id);
        return view('agenda.edit-forum-panel', compact('forumPanel'));
    }

    public function update(Request $request, $id)
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

        $forumPanel = ViewForumPanel::findOrFail($id);
        $forumPanel->update($request->all());

        return redirect()->route('forum-panel.index')->with('success', 'Forum panel updated successfully.');
    }
    // Menampilkan daftar forum panel
    public function index()
    {
        $forumPanels = ViewForumPanel::all(); // Ambil semua data dari tabel forum_panels
        return view('agenda.view-forum-panel', compact('forumPanels'));
    }

    // Menampilkan form untuk menambah data forum panel
    public function create()
    {
        return view('agenda.forum-panel');
    }

    // Menyimpan data forum panel
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'hari_pelaksanaan' => 'required',
            'waktu' => 'required',
            'tempat_pelaksanaan' => 'required',
            'kriteria' => 'required',
            'jenis_industri' => 'required',
            'hasil' => 'required',
        ]);

        // Menyimpan data ke database
        ViewForumPanel::create($request->all());

        return redirect()->route('forum-panel.index')->with('success', 'Forum Panel berhasil ditambahkan');
    }
}
