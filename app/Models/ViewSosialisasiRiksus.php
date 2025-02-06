<?php

// app/Models/SosialisasiRiksus.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewSosialisasiRiksus extends Model
{
    use HasFactory;

    protected $table = 'view_sosialisasi_riksus'; // Nama tabel di database
    protected $fillable = ['judul_sosialisasi',
        'hari_tanggal',
        'tempat',
        'keterangan_peserta',
        'kesimpulan',]; // Sesuaikan dengan kolom tabel yang ada
}
