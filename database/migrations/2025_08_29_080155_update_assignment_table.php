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
        Schema::table('assignments', function (Blueprint $table) {
            // Add new columns
            $table->integer('day_left')->nullable()->after('deadline');
            $table->foreignId('grade_id')->after('day_left')->constrained('grades')->onDelete('cascade');
            $table->foreignId('teacher_id')->after('subject_id')->constrained('teachers')->onDelete('cascade');
            $table->enum('status', ['submitted', 'unsubmitted'])->nullable()->after('teacher_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('assignments', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['grade_id']);
            $table->dropForeign(['teacher_id']);

            // Then drop the columns
            $table->dropColumn(['day_left', 'grade_id', 'teacher_id', 'status']);
        });
    }
};
