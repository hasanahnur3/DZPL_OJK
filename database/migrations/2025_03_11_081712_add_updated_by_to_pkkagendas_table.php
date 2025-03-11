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
        Schema::table('pkkagendas', function (Blueprint $table) {
            $table->string('last_updated_by')->nullable()->after('hasil');
        });
    }
    
    public function down()
    {
        Schema::table('pkkagendas', function (Blueprint $table) {
            $table->dropColumn('last_updated_by');
        });
    }
};
