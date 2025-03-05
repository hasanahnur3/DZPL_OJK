<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('rapim', function (Blueprint $table) {
            $table->string('updated_by')->nullable();  // Menambahkan kolom updated_by
        });
    }

    public function down()
    {
        Schema::table('rapim', function (Blueprint $table) {
            $table->dropColumn('updated_by');  // Menghapus kolom updated_by jika rollback
        });
    }

};
