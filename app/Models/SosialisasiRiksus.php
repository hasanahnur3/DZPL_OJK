<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosialisasiRiksus extends Model
{
    use HasFactory;

    protected $table = 'sosialisasi_riksus';

    protected $fillable = [
        'judul_sosialisasi',
        'hari_tanggal',
        'tempat',
        'keterangan_peserta',
        'kesimpulan',
    ];
}
