<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riksus extends Model
{
    use HasFactory;
    
    protected $table = 'riksus';

    protected $fillable = [
        'kode_riskus', 'jenis_industri', 'nama_perusahaan',
        'no_nd_pelimpahan', 'tanggal_nd_pelimpahan', 'no_rkpk',
        'tanggal_rkpk', 'no_surat_tugas', 'tanggal_surat_tugas',
        'periode_pemeriksaan_surat_tugas', 'tanggal_qa', 'tanggal_expose',
        'paparan_ke_pvml', 'no_nd_ke_dpjk', 'tanggal_nd_ke_dpjk',
        'no_bast_ke_dpjk', 'tanggal_bast_ke_dpjk', 'no_lhpk_ke_dpjk',
        'tanggal_lhpk_ke_dpjk', 'no_nd_penyampaian_lhpk_ke_pengawas_dpjk',
        'tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk', 'tanggal_kpkp',
        'no_siputri', 'tanggal_siputri', 'tanggal_persetujuan_kadep'
    ];
}

