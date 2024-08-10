<?php

use App\Http\Controllers\LaboratoryTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/laboratory-tests', [LaboratoryTestController::class, 'index']);
Route::post('/patient-record-update', [LaboratoryTestController::class, 'store']);
