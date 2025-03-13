<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tka extends Model
{
    use HasFactory;

    protected $table = 'tka';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'jenis_industri',
        'nama_perusahaan',
        'nomor_surat_permohonan',
        'tanggal_surat_permohonan',
        'status_perizinan',
        'jenis_output',
        'tanggal_dok_lengkap',
        'no_surat_pencatatan',
        'tanggal_surat_pencatatan',
        'jumlah_hari_kerja'
    ];

    public function index()
    {
        // Ambil data status perizinan dari database
        $statusPerizinanCounts = Tka::groupBy('status_perizinan')
            ->selectRaw('status_perizinan, COUNT(*) as total')
            ->pluck('total', 'status_perizinan');

        return view('dashboard', compact('statusPerizinanCounts'));
    }
}
