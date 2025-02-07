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
    protected $fillable = ['jenis_industri', 'nama_perusahaan'];
}
