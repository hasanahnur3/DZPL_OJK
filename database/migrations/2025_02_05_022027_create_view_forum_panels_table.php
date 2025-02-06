<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('view_forum_panels', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->date('hari_pelaksanaan');
            $table->time('waktu');
            $table->string('tempat_pelaksanaan');
            $table->text('kriteria');
            $table->string('jenis_industri');
            $table->text('hasil');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_panels');
    }
};
