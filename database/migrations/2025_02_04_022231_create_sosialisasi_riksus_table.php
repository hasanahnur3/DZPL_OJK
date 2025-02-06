<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sosialisasi_riksus', function (Blueprint $table) {
            $table->id();
            $table->string('judul_sosialisasi');
            $table->date('hari_tanggal');
            $table->string('tempat');
            $table->text('keterangan_peserta');
            $table->text('kesimpulan');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sosialisasi_riksus');
    }
    
};
