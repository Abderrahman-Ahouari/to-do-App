<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Taskcontroller;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Task routes
    Route::post('/tasks', [Taskcontroller::class, 'store']);
    Route::put('/tasks/{id}', [Taskcontroller::class, 'update']);
    Route::delete('/tasks/{id}', [Taskcontroller::class, 'destroy']);
    Route::get('/projects/{project_id}/tasks', [Taskcontroller::class, 'indexByProject']);
});

