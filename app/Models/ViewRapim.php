<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewRapim extends Model
{
    use HasFactory;

    protected $table = 'rapim';
    protected $fillable = ['tanggal', 'topik', 'hasil'];
}
