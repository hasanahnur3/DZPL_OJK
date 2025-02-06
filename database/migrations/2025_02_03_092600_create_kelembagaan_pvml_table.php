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
    Schema::create('kelembagaan_pvml', function (Blueprint $table) {
        $table->id();
        $table->string('jenis_industri', 33)->nullable();
        $table->string('nama_perusahaan', 54)->nullable();
        $table->string('detail_izin', 255)->nullable();
        $table->string('status', 23)->nullable();
        $table->string('nomor_surat_permohonan', 80)->nullable();
        $table->date('tanggal_surat_permohonan')->nullable();
        $table->date('tanggal_pengajuan_sistem')->nullable();
        $table->date('tanggal_dokumen_lengkap')->nullable();
        $table->date('tanggal_selesai_analisis')->nullable();
        $table->integer('sla')->nullable();
        $table->string('nomor_surat', 11)->nullable();
        $table->date('tanggal_surat')->nullable();
        $table->string('jumlah_hari_kerja', 17)->nullable();
        $table->string('aksi', 4)->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('kelembagaan_pvml');
}

};
