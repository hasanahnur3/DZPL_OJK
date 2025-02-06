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
        Schema::create('pkk_agendas', function (Blueprint $table) {
            $table->id();
            $table->date('hari_tanggal');
            $table->time('waktu');
            $table->string('nama_perusahaan');
            $table->string('peserta');
            $table->string('jabatan');
            $table->string('zoom');
            $table->string('pic');
            $table->string('penguji');
            $table->string('penguji1');
            $table->string('penguji2');
            $table->string('hasil');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pkk_agendas');
    }
    
};
