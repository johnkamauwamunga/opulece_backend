<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('student', [StudentController::class, 'index']);
Route::post('student/create', [StudentController::class, 'create']);
Route::put('student/edit/{id}', [StudentController::class, 'edit']);
Route::delete('student/del/{id}', [StudentController::class, 'del']);
