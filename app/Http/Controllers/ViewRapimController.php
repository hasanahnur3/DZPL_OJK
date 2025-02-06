<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rapim;

class ViewRapimController extends Controller
{
    public function index()
    {
        $rapim = Rapim::all();
        return view('agenda.view-rapat-pimpinan', compact('rapim'));
    }

    public function create()
    {
        return view('agenda.rapat-pimpinan');
    }

    public function store(Request $request)
    {
        Rapim::create($request->validate([
            'tanggal' => 'required|date',
            'topik' => 'required|string',
            'hasil' => 'required|string',
        ]));

        return redirect()->route('rapat-pimpinan.index')->with('success', 'Agenda berhasil ditambahkan!');
    }
}