<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

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

