<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassGradeController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\TranscriptController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postlogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('check.login')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('classes')->middleware('can:is-admin')->group(function () {
        //index
        Route::get('/grade-{id}', [ClassGradeController::class, 'index'])->name('classes.index');
        //search
        Route::post('/search', [ClassGradeController::class, 'search'])->name('classes.search');
        //create
        Route::get('/create', [ClassGradeController::class, 'create'])->name('classes.create');
        Route::post('/store', [ClassGradeController::class, 'store'])->name('classes.store');
        //update
        Route::get('/edit/{id}', [ClassGradeController::class, 'edit'])->name('classes.edit');
        Route::post('/update/{id}', [ClassGradeController::class, 'update'])->name('classes.update');
        //delete
        Route::get('/delete/{id}', [ClassGradeController::class, 'delete'])->name('classes.delete');
    });

    Route::prefix('users')->middleware('can:admin-1')->group(function () {
        //index
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        // //search
        // Route::post('/search', [UserController::class, 'search'])->name('users.search');
        //create
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        // update
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
        //delete
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    });

    Route::prefix('school-year')->middleware('can:is-admin')->group(function () {
        //index
        Route::get('/', [SchoolYearController::class, 'index'])->name('school-year.index');
        //create
        Route::get('/create', [SchoolYearController::class, 'create'])->name('school-year.create');
        Route::post('/store', [SchoolYearController::class, 'store'])->name('school-year.store');
        //delete
        Route::get('/delete/{id}', [SchoolYearController::class, 'delete'])->name('school-year.delete');
    });

    Route::prefix('teacher')->middleware('can:is-admin')->group(function () {
        //index
        Route::get('/', [TeacherController::class, 'index'])->name('teacher.index');
        //search
        Route::post('/search', [TeacherController::class, 'search'])->name('teacher.search');
        //create
        Route::get('/create', [TeacherController::class, 'create'])->name('teacher.create');
        Route::post('/store', [TeacherController::class, 'store'])->name('teacher.store');
        //update
        Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('teacher.edit');
        Route::post('/update/{id}', [TeacherController::class, 'update'])->name('teacher.update');
        //delete
        Route::get('/delete/{id}', [TeacherController::class, 'delete'])->name('teacher.delete');
    });

    Route::prefix('students')->group(function () {
        //index
        Route::get('/class/{id}', [StudentController::class, 'index'])->name('student.index');
        //search
        Route::post('/search', [StudentController::class, 'search'])->name('student.search');
        // create
        Route::get('/create', [StudentController::class, 'create'])->name('student.create');
        Route::post('/store', [StudentController::class, 'store'])->name('student.store');
        //update
        Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
        Route::post('/update/{id}', [StudentController::class, 'update'])->name('student.update');
        //delete
        Route::get('/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');

        //transcript
        //index
        Route::get('/transcript/{id}-{grade}', [TranscriptController::class, 'index'])->name('student.transcript');
        //create
        Route::get('/transcript/create/{id}-{grade}', [TranscriptController::class, 'create'])->name('student.transcript-create');
        Route::post('/transcript/store/{id}-{grade}', [TranscriptController::class, 'store'])->name('student.transcript-store');
        //update
        Route::get('/transcript/edit/{id}-{grade}/{idTS}', [TranscriptController::class, 'edit'])->name('student.transcript-edit');
        Route::post('/transcript/update/{id}-{grade}/{idTS}', [TranscriptController::class, 'update'])->name('student.transcript-update');
        //delete
        Route::get('/transcript/delete/{id}-{grade}/{idTS}', [TranscriptController::class, 'delete'])->name('student.transcript-delete');
    });

});


Route::middleware('student.login')->prefix('student/{student_code}')->group(function () {
    Route::get('/', [StudentLoginController::class, 'index'])->name('student.login-home');
    Route::get('/transcript/{id_grade}', [StudentLoginController::class, 'transcript'])->name('student.login-transcript');
});


