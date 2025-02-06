<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewPkkAgenda extends Model {
    use HasFactory;

    protected $table = 'pkk_agendas'; // Nama tabel di database

    protected $fillable = [
        'hari_tanggal',
        'waktu',
        'nama_perusahaan',
        'peserta',
        'jabatan',
        'zoom',
        'pic',
        'penguji',
        'hasil',
    ];
}
