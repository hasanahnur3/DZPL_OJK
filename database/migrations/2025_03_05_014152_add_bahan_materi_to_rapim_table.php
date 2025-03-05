<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBahanMateriToRapimTable extends Migration
{
    /**
     * Menjalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rapim', function (Blueprint $table) {
            // Menambahkan kolom bahan_materi
            $table->string('bahan_materi')->nullable(); // Menyimpan path file bahan materi
        });
    }

    /**
     * Membatalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rapim', function (Blueprint $table) {
            $table->dropColumn('bahan_materi'); // Menghapus kolom bahan_materi
        });
    }
}
