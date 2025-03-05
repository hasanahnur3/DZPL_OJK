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
        Schema::table('rapims', function (Blueprint $table) {
            $table->string('hasil')->nullable(); // Kolom untuk menyimpan path file
        });
    }
    
    public function down()
    {
        Schema::table('rapims', function (Blueprint $table) {
            $table->dropColumn('hasil'); // Hapus kolom hasil saat rollback
        });
    }
};
