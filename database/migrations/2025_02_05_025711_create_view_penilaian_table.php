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
    Schema::create('view_penilaian', function (Blueprint $table) {
        $table->id();
        $table->string('jenis_industri');
        $table->string('nama_perusahaan');
        $table->string('nama_pihak_utama');
        $table->string('jabatan');
        $table->string('status');
        $table->string('nomor_surat_permohonan');
        $table->date('tanggal_surat_permohonan');
        $table->date('tanggal_pengajuan_sistem');
        $table->date('tanggal_dok_lengkap');
        $table->enum('perlu_klarifikasi', ['iya', 'tidak']);
        $table->date('tanggal_klarifikasi')->nullable();
        $table->enum('hasil', ['direkomendasikan', 'tidak direkomendasikan']);
        $table->date('tanggal_sk')->nullable();
        $table->string('nomor_persetujuan');
        $table->date('tanggal_persetujuan');
        $table->integer('jumlah_hari_kerja');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
