<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CatController;

Route::get('/', function () {
    return redirect()->route('students.index');
});


Route::get('/students_excel', [StudentController::class, 'excel']);
Route::get('/students_hello', [StudentController::class, 'sayHello']);
Route::resource('students', StudentController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('cars', CarController::class);
Route::resource('cats', CatController::class);
