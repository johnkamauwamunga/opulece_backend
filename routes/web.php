<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});
// Route::get('student', [StudentController::class, 'studentIndex']);

Route::post('register/create', [StudentController::class, 'studentIndex'])->name('register.create');
