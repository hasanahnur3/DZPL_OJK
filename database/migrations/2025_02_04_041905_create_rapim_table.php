<?php

// File: database/migrations/2025_02_04_000000_create_rapim_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapimTable extends Migration
{
    public function up()
    {
        Schema::create('rapim', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('topik');
            $table->text('hasil');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rapim');
    }
}
