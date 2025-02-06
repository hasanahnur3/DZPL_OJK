<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('riksus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_riskus')->unique();
            $table->string('jenis_industri')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('no_nd_pelimpahan')->nullable();
            $table->date('tanggal_nd_pelimpahan')->nullable();
            $table->string('no_rkpk')->nullable();
            $table->date('tanggal_rkpk')->nullable();
            $table->string('no_surat_tugas')->nullable();
            $table->date('tanggal_surat_tugas')->nullable();
            $table->string('periode_pemeriksaan_surat_tugas')->nullable();
            $table->date('tanggal_qa')->nullable();
            $table->date('tanggal_expose')->nullable();
            $table->string('paparan_ke_pvml')->nullable();
            $table->string('no_nd_ke_dpjk')->nullable();
            $table->date('tanggal_nd_ke_dpjk')->nullable();
            $table->string('no_bast_ke_dpjk')->nullable();
            $table->date('tanggal_bast_ke_dpjk')->nullable();
            $table->string('no_lhpk_ke_dpjk')->nullable();
            $table->date('tanggal_lhpk_ke_dpjk')->nullable();
            $table->string('no_nd_penyampaian_lhpk_ke_pengawas_dpjk')->nullable();
            $table->date('tanggal_nd_penyampaian_lhpk_ke_pengawas_dpjk')->nullable();
            $table->date('tanggal_kpkp')->nullable();
            $table->string('no_siputri')->nullable();
            $table->date('tanggal_siputri')->nullable();
            $table->date('tanggal_persetujuan_kadep')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riksus');
    }
};
