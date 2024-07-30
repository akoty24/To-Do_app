<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('restore_task/{id}', [TaskController::class, 'restore']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::Resource('tasks', TaskController::class);


    Route::put('/update_status/{id}',  [TaskController::class, 'updateStatus']);
});
Route::get('get_by_Category/{id}', [TaskController::class, 'getByCategory']);

Route::Resource('categories', CategoryController::class);
