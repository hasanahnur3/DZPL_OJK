<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTkaTable extends Migration
{
    public function up()
    {
        Schema::create('tka', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_industri');
            $table->string('nama_perusahaan');
            $table->string('nomor_surat_permohonan');
            $table->date('tanggal_surat_permohonan');
            $table->enum('status_perizinan', ['Dalam proses analisis', 'Kelengkapan dok', 'Selesai', 'Ditolak/Dikembalikan']);
            $table->enum('jenis_output', ['pencatatan', 'penolakan']);
            $table->date('tanggal_dok_lengkap')->nullable();
            $table->string('no_surat_pencatatan')->nullable();
            $table->date('tanggal_surat_pencatatan')->nullable();
            $table->string('jumlah_hari_kerja', 17)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tka');
    }
}
