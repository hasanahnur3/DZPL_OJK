<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function updateby()
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->string('updated_by')->nullable()->after('updated_at');
        });
    }
};
