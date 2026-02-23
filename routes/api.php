<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::post('/projects', [ProjectController::class, 'store']);
    Route::post('/projects/{id}/apply', [ProjectController::class, 'apply']);
    Route::post('/projects/{id}/complete', [ProjectController::class, 'markComplete']);
    Route::post('/projects/{id}/approve', [ProjectController::class, 'approve']);
});
