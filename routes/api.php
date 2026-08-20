<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\ViewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) { return $request->user(); });
Route::post('/login', [AuthController::class, 'login']);


Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::middleware('auth:api')->post('/courses', [CourseController::class, 'store']);
Route::middleware('auth:api')->put('/courses/{id}', [CourseController::class, 'update']);
Route::middleware('auth:api')->delete('/courses/{id}', [CourseController::class, 'destroy']);


Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);

Route::middleware('auth:api')->post('/categories', [CategoryController::class, 'store']);
Route::middleware('auth:api')->put('/categories/{id}', [CategoryController::class, 'update']);
Route::middleware('auth:api')->delete('/categories/{id}',[CategoryController::class, 'destroy']);


Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/{id}', [ItemController::class, 'show']);

Route::middleware('auth:api')->post('/items', [ItemController::class, 'store']);
Route::middleware('auth:api')->put('/items/{id}', [ItemController::class, 'update']);
Route::middleware('auth:api')->delete('/items/{id}', [ItemController::class, 'destroy']);


Route::get('/comments', [CommentController::class, 'index']);
Route::get('/comments/{id}', [CommentController::class, 'show']);

Route::middleware('auth:api')->post('/comments', [CommentController::class, 'store']);
Route::middleware('auth:api')->put('/comments/{id}', [CommentController::class, 'update']);
Route::middleware('auth:api')->delete('/comments/{id}', [CommentController::class, 'destroy']);


Route::get('/views', [ViewController::class, 'index']);
Route::get('/views/{id}', [ViewController::class, 'show']);

Route::middleware('auth:api')->post('/views', [ViewController::class, 'store']);
Route::middleware('auth:api')->put('/views/{id}', [ViewController::class, 'update']);
Route::middleware('auth:api')->delete('/views/{id}', [ViewController::class, 'destroy']);