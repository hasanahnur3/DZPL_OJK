<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{
    // Lembaga Keuangan Mikro
    public function lembagaKeuanganMikro()
    {
        return view('list.lembaga-keuangan-mikro');
    }

    // LPBBTI
    public function lpbbti()
    {
        return view('list.lpbbti');
    }

    // Pergadaian
    public function pergadaian()
    {
        return view('list.pergadaian');
    }

    // Perusahaan Modal Ventura
    public function perusahaanModalVentura()
    {
        return view('list.perusahaan-modal-ventura');
    }

    // Perusahaan Pembiayaan
    public function perusahaanPembiayaan()
    {
        return view('list.perusahaan-pembiayaan');
    }

    // Sue Generis
    public function sueGeneris()
    {
        return view('list.sue-generis');
    }
}
