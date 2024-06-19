<?php

use App\Http\Controllers\DistrictController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CostTypeController;
use Illuminate\Support\Facades\Gate;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login.form');

Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('trips', App\Http\Controllers\TripController::class);
Route::resource('vehicles', App\Http\Controllers\VehicleController::class);
Route::resource('insurances', App\Http\Controllers\InsuranceController::class);
Route::resource('projects', App\Http\Controllers\ProjectController::class);
Route::resource('trip-details', App\Http\Controllers\TripDetailController::class);

Route::delete('employees.deleteSelected', [App\Http\Controllers\EmployeeController::class, 'deleteSelected'])->name('employees.deleteSelected');
Route::delete('vehicles.deleteSelected', [VehicleController::class, 'deleteSelected'])->name('vehicles.deleteSelected');
Route::delete('projects.deleteSelected', [App\Http\Controllers\ProjectController::class, 'deleteSelected'])->name('projects.deleteSelected');
Route::delete('trips.deleteSelected', [App\Http\Controllers\TripController::class, 'deleteSelected'])->name('trips.deleteSelected');
Route::delete('insurances.deleteSelected', [App\Http\Controllers\InsuranceController::class, 'deleteSelected'])->name('insurances.deleteSelected');


Route::get('/vehicles/{vehicle}/download-pdf', [App\Http\Controllers\VehicleController::class, 'downloadPdf'])->name('vehicles.downloadPdf');

Route::get('/employees/{id}/export-csv', [EmployeeController::class, 'exportCsv'])->name('employees.exportCsv');


Route::get('/districts/{country}', [DistrictController::class, 'getDistrictsByCountry']);

Route::post('employees-import', [EmployeeController::class, 'import'])->name('employee.import');

Route::get('/districts/{country}', [DistrictController::class, 'getDistrictsByCountry']);

Route::post('/employees/importCsv', [EmployeeController::class, 'importCsv'])->name('employees.importCsv');

Route::get('/403', function () {return view('components.Errors.403');})->name('error.403');
