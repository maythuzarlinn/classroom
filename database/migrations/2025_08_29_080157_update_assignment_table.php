<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add grade_id to exams table
        Schema::table('exams', function (Blueprint $table) {
            $table->unsignedBigInteger('grade_id')->nullable()->after('subject_id');
        });

        // Add status to exam_results table
        Schema::table('exam_results', function (Blueprint $table) {
            $table->string('status')->nullable()->after('mark');
        });
    }

    /**
     * Reverse the migrations.
     */
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove grade_id from exams table
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('grade_id');
        });

        // Remove status from exam_results table
        Schema::table('exam_results', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
