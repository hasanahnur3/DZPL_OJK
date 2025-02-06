<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('view_kelembagaan_pvml', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lembaga');
            $table->string('alamat');
            $table->string('kontak');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('view_kelembagaan_pvml');
    }
};
