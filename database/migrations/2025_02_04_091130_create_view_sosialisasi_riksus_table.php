<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_sosialisasi_riksus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewSosialisasiRiksusTable extends Migration
{
    public function up()
    {
        Schema::create('view_sosialisasi_riksus', function (Blueprint $table) {
            $table->id();
            $table->string('judul_sosialisasi');
            $table->date('hari_tanggal');
            $table->string('tempat');
            $table->text('keterangan_peserta');
            $table->text('kesimpulan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('view_sosialisasi_riksus');
    }
}
