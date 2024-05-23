<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployerController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/jobs', [JobController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('jobs', JobController::class)->except('update', 'index');
    Route::patch('jobs/{job}', [JobController::class, 'update']);
    Route::put('jobs/{job}', [JobController::class, 'replace']);
    Route::apiResource('tags', TagController::class);
    Route::apiResource('employers', EmployerController::class);

});
