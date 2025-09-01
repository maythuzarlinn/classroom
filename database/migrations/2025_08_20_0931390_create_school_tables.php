<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolTables extends Migration
{
    public function up()
    {
        // Grade
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Subject
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Classroom
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Teacher
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact')->nullable();
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Class
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade');
            $table->string('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Student
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('grade_id')->nullable()->constrained();
            $table->date('date_of_birth');
            $table->string('parent_name');
            $table->string('contact');
            $table->enum('status', ['active', 'inactive']);
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // class_student
        Schema::create('class_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_class_id')->constrained('school_classes')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Attendance
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->enum('status', ['present', 'absent', 'late']);
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Assignments
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('deadline');
            $table->integer('day_left')->nullable()->constrained();
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->json('status')->nullable();
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Assignment Results
        Schema::create('assignment_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('assignment_id')->constrained('assignments')->onDelete('cascade');
            $table->decimal('mark', 5, 2)->nullable();
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Exam
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Exam Results
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->decimal('mark', 5, 2)->nullable();
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Test
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });

        // Test Results
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->decimal('mark', 5, 2)->nullable();
            $table->datetime('created_at')->nullable()->constrained();
            $table->datetime('updated_at')->nullable()->constrained();
            $table->datetime('deleted_at')->nullable()->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tests');
        Schema::dropIfExists('exam_results');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('assignment_results');
        Schema::dropIfExists('assignments');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('students');
        Schema::dropIfExists('school_classes');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('classrooms');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('grades');
    }
}
