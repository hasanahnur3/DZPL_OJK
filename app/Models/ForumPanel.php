<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPanel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan',
        'hari_pelaksanaan',
        'waktu',
        'tempat_pelaksanaan',
        'kriteria',
        'jenis_industri',
        'hasil',
    ];
}
