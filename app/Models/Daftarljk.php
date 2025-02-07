<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftarljk extends Model
{
    use HasFactory;

    protected $table = 'kelembagaan_pvml'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel
    public $timestamps = false; // Menonaktifkan timestamp jika tidak digunakan

    // Jika Anda hanya ingin memfasilitasi kolom tertentu
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
        'jumlah_hari_kerja',
        'aksi'
    ];
}
