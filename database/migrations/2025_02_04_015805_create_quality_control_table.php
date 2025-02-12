<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('quality_control', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_industri');
            $table->string('nama_perusahaan');
            $table->text('criteria');
            $table->string('pvml_utama');
            $table->string('special_monitoring_status');
            $table->string('intensive_monitoring_status');
            $table->text('other_considerations');
            $table->date('forum_date');
            $table->text('financial_issues');
            $table->text('non_financial_issues');
            $table->text('root_cause');
            $table->text('main_recommendation');
            $table->text('supporting_recommendation');
            $table->date('follow_up_deadline');
            $table->string('panelists');
            $table->string('supervisors');
            $table->date('document_submission_date');
            $table->integer('working_days');
            $table->string('document_number');
            $table->date('follow_up_submission_date');
            $table->enum('follow_up_status', ['Belum Lengkap', 'Sudah Lengkap'])->nullable(); // Use enum
            $table->text('follow_up_status_description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quality_control');
    }
};
