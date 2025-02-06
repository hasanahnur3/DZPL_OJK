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
        Schema::create('dirkoms', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_industri');
            $table->string('nama_perusahaan');
            $table->string('nomor_surat_permohonan');
            $table->date('tanggal_surat_permohonan');
            $table->string('status_perizinan');
            $table->string('jenis_output');
            $table->date('tanggal_dok_lengkap');
            $table->string('no_surat_pencatatan');
            $table->date('tanggal_surat_pencatatan');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dirkom');
    }
};
