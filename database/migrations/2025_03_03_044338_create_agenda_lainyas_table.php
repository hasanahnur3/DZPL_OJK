<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaLainyasTable extends Migration
{
    public function up()
    {
        Schema::create('agenda_lainyas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('topik');
            $table->text('hasil');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agenda_lainyas');
    }
}
