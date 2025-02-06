<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewPkkAgenda;

class ViewPkkAgendaController extends Controller {
    public function index() {
        $agendas = ViewPkkAgenda::all(); // Ambil semua data dari tabel
        return view('agenda.view-penilaian-kemampuan', compact('agendas'));
    }

    public function create() {
        return view('agenda.penilaian-kemampuan');
    }

    public function store(Request $request) {
        ViewPkkAgenda::create($request->all());
        return redirect()->route('view-penilaian-kemampuan.index')->with('success', 'Data berhasil ditambahkan!');
    }
    
}
