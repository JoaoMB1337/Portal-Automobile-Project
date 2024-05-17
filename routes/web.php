<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login.form');

Route::resource('/employees', App\Http\Controllers\EmployeeController::class);

Route::resource('/trips', App\Http\Controllers\TripController::class);

Route::resource('/vehicles', App\Http\Controllers\VehicleController::class);

Route::resource('insurances', App\Http\Controllers\InsuranceController::class);


Route::resource('/projects', App\Http\Controllers\ProjectController::class);

Route::delete('/employees.deleteSelected', [App\Http\Controllers\EmployeeController::class, 'deleteSelected'])->name('employees.deleteSelected');

Route::delete('vehicles.deleteSelected', [App\Http\Controllers\VehicleController::class, 'deleteSelected'])->name('vehicles.deleteSelected');

Route::get('/vehicles/{vehicle}/download-pdf', [App\Http\Controllers\VehicleController::class, 'downloadPdf'])->name('vehicles.downloadPdf');
