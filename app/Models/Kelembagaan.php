<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelembagaan extends Model
{
    use HasFactory;

    protected $table = 'kelembagaan'; // Sesuaikan dengan nama tabel

    protected $fillable = [
        'jenis_industri',
        'nama_perusahaan',
        'detail_izin',
        'status',
        'nomor_surat_permohonan',
        'tanggal_surat_permohonan',
        'tanggal_pengajuan_sistem',
        'tanggal_dokumen_lengkap',
        'tanggal_selesai_analisis',
        'sla',
        'nomor_surat',
        'tanggal_surat',
        'jumlah_hari_kerja'
    ];
}
