<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('quality_control', function (Blueprint $table) {
            $table->id();
            $table->string('industry_type');
            $table->text('criteria');
            $table->string('company_name');
            $table->date('forum_date')->nullable();
            $table->text('financial_issues')->nullable();
            $table->text('non_financial_issues')->nullable();
            $table->text('root_cause')->nullable();
            $table->text('main_recommendation')->nullable();
            $table->text('supporting_recommendation')->nullable();
            $table->date('follow_up_deadline')->nullable();
            $table->text('panelists')->nullable();
            $table->text('supervisors')->nullable();
            $table->date('document_submission_date')->nullable();
            $table->integer('working_days')->nullable();
            $table->string('document_number')->nullable();
            $table->date('follow_up_submission_date')->nullable();
            $table->enum('follow_up_status', ['Belum Lengkap', 'Sudah Lengkap'])->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('quality_control');
    }
};
