<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AppointmentController;



Route::get('/', function () {
    return redirect('/admin/dashboard');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AdminController::class, 'login'])->name('login');


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');})->name('admin.logout');




Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('activate-user/{user}', [UserController::class, 'activateUser'])->name('activate-user');
});

Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::post('/appointments', [AppointmentController::class, 'store']);


 




Route::middleware(['auth'])->group(function () {
    Route::get('/admin/patients/create', [PatientsController::class, 'create'])->name('admin.patients.create');
    Route::post('/admin/patients/store', [PatientsController::class, 'store'])->name('admin.patients.store');
  
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/appointments', [AppointmentController::class, 'index'])->name('admin.appointments.index');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('admin.appointments.show');
    Route::get('/admin/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('admin.appointments.edit');
    Route::put('/admin/appointments/{appointment}', [AppointmentController::class, 'update'])->name('admin.appointments.update');
    Route::delete('/admin/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::get('/admin/appointments/create', [AppointmentController::class, 'create'])->name('admin.appointments.create');
    Route::post('/admin/appointments/store', [AppointmentController::class, 'adminstore'])->name('admin.appointments.store');
    Route::get('/admin/patients', [PatientsController::class, 'index'])->name('admin.patients.index');
    Route::get('admin/patients/{patient}', [PatientsController::class, 'show'])->name('admin.patients.show');
    Route::get('/admin/patients/{id}/edit', [PatientsController::class, 'editPatient'])->name('admin.patients.edit');
    Route::put('/admin/patients/{id}', [PatientsController::class, 'updatePatient'])->name('admin.patients.update');
    Route::delete('/admin/patients/{id}', [PatientsController::class, 'destroy'])->name('admin.patients.destroy');
    Route::get('/admin/patients/{id}/history', [PatientsController::class, 'history'])->name('admin.patients.history');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('activate-user/{user}', [UserController::class, 'activateUser'])->name('activate-user');
});