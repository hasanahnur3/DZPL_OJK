<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function rapatPimpinan()
    {
        return view('agenda.rapat-pimpinan');
    }

    public function penilaianKemampuan()
    {
        return view('agenda.penilaian-kemampuan');
    }

    public function forumPanel()
    {
        return view('agenda.forum-panel');
    }

    public function sosialisasiRiksus()
    {
        return view('agenda.sosialisasi-riksus');
    }
}
