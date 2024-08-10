<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\LaboratoryTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/laboratory-tests', [LaboratoryTestController::class, 'index']);
    Route::post('/patient-record-update', [LaboratoryTestController::class, 'store']);
});
