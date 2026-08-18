<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->post('/courses', [CourseController::class, 'store']);

Route::middleware('auth:api')->put('/courses/{id}', [CourseController::class, 'update']);
Route::middleware('auth:api')->delete('/courses/{id}', [CourseController::class, 'destroy']);