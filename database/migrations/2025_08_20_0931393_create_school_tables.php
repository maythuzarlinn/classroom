<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolTables extends Migration
{
    public function up()
    {
        // 🔹 Grades
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Subjects
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Classrooms
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Teachers
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 School Classes
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade');
            $table->string('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Students
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->foreignId('grade_id')->nullable()->constrained('grades')->onDelete('set null');
            $table->date('date_of_birth');
            $table->string('parent_name');
            $table->string('contact');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Class–Student Pivot
        Schema::create('class_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_class_id')->constrained('school_classes')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Attendance
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->enum('status', ['present', 'absent', 'late']);
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Assignments
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('deadline');
            $table->integer('day_left')->nullable();
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->json('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Assignment Results
        Schema::create('assignment_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('assignment_id')->constrained('assignments')->onDelete('cascade');
            $table->decimal('mark', 5, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Exams
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            // Use TEXT instead of VARCHAR
            $table->text('exam_title');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->integer('day_left')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Exam Results
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            // Use TEXT for exam_title and remove foreign key
            $table->text('exam_title');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->decimal('mark', 5, 2)->nullable();
            $table->enum('status', ['pass', 'fail']);
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Tests
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // 🔹 Test Results
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->decimal('mark', 5, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_results');
        Schema::dropIfExists('tests');
        Schema::dropIfExists('exam_results');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('assignment_results');
        Schema::dropIfExists('assignments');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('class_students');
        Schema::dropIfExists('students');
        Schema::dropIfExists('school_classes');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('classrooms');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('grades');
    }
}
