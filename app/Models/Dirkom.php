<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // pastikan Carbon di-import

class Dirkom extends Model
{
    use HasFactory;

    protected $table = 'dirkom';

    protected $fillable = [
        'jenis_industri',
        'nama_perusahaan',
        'nomor_surat_permohonan',
        'tanggal_surat_permohonan',
        'status_perizinan',
        'jenis_output',
        'tanggal_dok_lengkap',
        'no_surat_pencatatan',
        'tanggal_surat_pencatatan'
    ];

    protected $dates = [
        'tanggal_surat_permohonan',
        'tanggal_dok_lengkap',
        'tanggal_surat_pencatatan'
    ];
}
