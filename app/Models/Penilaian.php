<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';
    
    protected $fillable = [
        'jenis_industri', 'nama_perusahaan', 'nama_pihak_utama', 'jabatan', 'status',
        'nomor_surat_permohonan', 'tanggal_surat_permohonan', 'tanggal_pengajuan_sistem',
        'tanggal_dok_lengkap', 'perlu_klarifikasi', 'tanggal_klarifikasi', 'hasil',
        'tanggal_sk', 'nomor_persetujuan', 'tanggal_persetujuan', 'jumlah_hari_kerja'
    ];
}
