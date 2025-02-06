<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PkkAgenda extends Model
{
    use HasFactory;

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
