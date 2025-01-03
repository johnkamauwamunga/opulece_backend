<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarBodyController;
use App\Http\Controllers\CarMakeController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CarTypeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\YardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// login
Route::post('login', [AuthController::class, 'login']);

// car body
Route::post('car/body', [CarBodyController::class, 'getAll']);
Route::post('body/create', [CarBodyController::class, 'create']);
Route::put('car/body/edit/{id}', [CarBodyController::class, 'edit']);
Route::delete('car/body/del/{id}', [CarBodyController::class, 'delete']);

// car make
Route::post('car/make', [CarMakeController::class, 'getAll']);
Route::post('make/create', [CarMakeController::class, 'create']);
Route::put('car/make/edit/{id}', [CarMakeController::class, 'edit']);
Route::delete('car/make/del/{id}', [CarMakeController::class, 'delete']);

// car model
Route::post('car/model', [CarModelController::class, 'getAll']);
Route::post('model/create', [CarModelController::class, 'create']);
Route::put('car/model/edit/{id}', [CarModelController::class, 'edit']);
Route::delete('car/model/del/{id}', [CarModelController::class, 'delete']);

// car type
Route::post('car/type', [CarTypeController::class, 'getAll']);
Route::post('car/type/create', [CarTypeController::class, 'create']);
Route::put('car/type/edit/{id}', [CarTypeController::class, 'edit']);
Route::delete('car/type/del/{id}', [CarTypeController::class, 'delete']);

// user type
Route::post('user/type', [UserTypeController::class, 'getAllUserType']);
Route::post('user/type/create', [UserTypeController::class, 'create']);
Route::put('user/type/edit/{id}', [UserTypeController::class, 'edit']);
Route::delete('user/type/del/{id}', [UserTypeController::class, 'deleteuser']);

// create a new user
Route::post('user', [UserController::class, 'getAllUsers']);
Route::post('user/create', [UserController::class, 'create']);
Route::put('user/edit/{id}', [UserController::class, 'edit']);
Route::delete('user/del/{id}', [UserController::class, 'deleteuser']);

// create new vehicle
Route::post('vehicle', [VehicleController::class, 'getAll']);
Route::post('vehicle/create', [VehicleController::class, 'create']);
Route::put('vehicle/edit/{id}', [VehicleController::class, 'edit']);
Route::delete('vehicle/del/{id}', [VehicleController::class, 'delete']);

// create new yard
Route::post('yard', [YardController::class, 'getAll']);
Route::post('yard/create', [YardController::class, 'create']);
Route::put('yard/edit/{id}', [YardController::class, 'edit']);
Route::delete('yard/del/{id}', [YardController::class, 'delete']);

// Delete staff and related user
Route::middleware('auth:sanctum')->delete('delete/user/{id}', [UserController::class, 'deleteuser']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('users', [UserController::class, 'getAllUsers']);


});


