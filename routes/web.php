<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SubjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

//Dashboard Routes
Route::get('/dashboard', function () {
    return view('dashboards\index');
});

//Student Routes
Route::resource('students', StudentController::class);
Route::namespace('Student')->prefix('student')->name('student.')->group(function () {
Route::get('/delete/{id}', [StudentController::class, 'delete'])->name('delete');
Route::post('/delete/{id}', [StudentController::class, 'delete'])->name('delete');
});

//Teachers Routes
Route::resource('teachers', TeacherController::class);

//Classroom Routes
Route::resource('classrooms', ClassroomController::class);

//Grade Routes
Route::resource('grades', GradeController::class);

//Class Routes
Route::resource('schoolclasses', SchoolClassController::class);

//Subject Routes
Route::resource('subjects', SubjectController::class);

//Subject Routes
Route::resource('attendances', AttendanceController::class);
Route::namespace('Attendance')->prefix('attendance')->name('attendance.')->group(function () {
Route::get('/grade/{id}', [AttendanceController::class, 'show'])->name('grade');
Route::post('/grade/{id}', [AttendanceController::class, 'show'])->name('grade');
Route::get('/delete/{id}', [AttendanceController::class, 'delete'])->name('delete');
Route::post('/delete/{id}', [AttendanceController::class, 'delete'])->name('delete');
});

//Assignment Routes
Route::resource('assignments', AssignmentController::class);
Route::namespace('Assignment')->prefix('assignment')->name('assignment.')->group(function () {
Route::get('/grade/{id}/{assignment_id}', [AssignmentController::class, 'show'])->name('grade');
Route::post('/grade/{id}/{assignment_id}', [AssignmentController::class, 'show'])->name('grade');
Route::get('/delete/{id}', [AssignmentController::class, 'delete'])->name('delete');
Route::post('/delete/{id}', [AssignmentController::class, 'delete'])->name('delete');
});

//Exam Routes
Route::resource('exams', ExamController::class);
Route::namespace('Exam')->prefix('exam')->name('exam.')->group(function () {
Route::get('/delete/{id}', [ExamController::class, 'delete'])->name('delete');
Route::post('/delete/{id}', [ExamController::class, 'delete'])->name('delete');
Route::get('/result', [ExamController::class, 'result'])->name('result');
});
