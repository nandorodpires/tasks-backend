<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return response()->json(['message' => 'API Tasks is running...'], 200);
});

/**
 * Auth
 */
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

/**
 * Users
 */
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);

/**
 * Tasks
 */
Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index']);
Route::post('/tasks', [\App\Http\Controllers\TaskController::class, 'store']);
Route::put('/tasks/{id}/done', [\App\Http\Controllers\TaskController::class, 'done']);
Route::put('/tasks/{id}', [\App\Http\Controllers\TaskController::class, 'update']);
Route::delete('/tasks/{id}', [\App\Http\Controllers\TaskController::class, 'destroy']);
