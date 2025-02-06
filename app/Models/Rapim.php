<?php

// File: app/Models/Rapim.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapim extends Model
{
    use HasFactory;

    protected $table = 'rapim';  // Pastikan ini sesuai dengan nama tabel di database

    protected $fillable = ['tanggal', 'topik', 'hasil'];
}
