<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kelembagaan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_industri');
            $table->string('nama_perusahaan');
            $table->string('detail_izin');
            $table->string('status');
            $table->string('nomor_surat_permohonan');
            $table->date('tanggal_surat_permohonan');
            $table->date('tanggal_pengajuan_sistem');
            $table->date('tanggal_dokumen_lengkap')->nullable();
            $table->date('tanggal_selesai_analisis')->nullable();
            $table->string('sla')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->integer('jumlah_hari_kerja')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelembagaan');
    }
};