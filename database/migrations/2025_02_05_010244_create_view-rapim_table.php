<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('view-rapim', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('topik');
            $table->text('hasil');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapim');
    }
};
