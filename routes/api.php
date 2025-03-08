<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\PatientsController;
use App\Http\Controllers\AppointmentController;

Route::post('/appointments', [AppointmentController::class, 'store']);
// Add the new route for checking the phone number
Route::get('/patients/check-phone', [PatientsController::class, 'checkPhone']);