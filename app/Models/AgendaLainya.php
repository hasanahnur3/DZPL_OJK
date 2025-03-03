<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaLainya extends Model
{
    use HasFactory;

    // Jika nama tabel di database tidak mengikuti konvensi plural, bisa diatur seperti ini
    protected $table = 'agenda_lainyas';  // Nama tabel yang digunakan di database

    // Tentukan kolom yang dapat diisi secara massal (Mass Assignment)
    protected $fillable = [
        'tanggal',
        'topik',
        'hasil',
    ];

    // Jika kamu ingin menyembunyikan kolom tertentu (misalnya, timestamps atau kolom lainnya)
    // protected $hidden = ['created_at', 'updated_at'];
}
