<?php

use App\Http\Controllers\DistrictController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckFirstLogin;

// Route to show the login form
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login.form');
Auth::routes(['register' => false]);

// Group routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Group routes that require the first login check middleware
    Route::middleware([CheckFirstLogin::class])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/vehicles/{vehicle}/download-pdf', [VehicleController::class, 'downloadPdf'])->name('vehicles.downloadPdf');
        Route::resource('employees', EmployeeController::class);
        Route::resource('trips', App\Http\Controllers\TripController::class);
        Route::resource('vehicles', VehicleController::class);
        Route::resource('insurances', App\Http\Controllers\InsuranceController::class);
        Route::resource('projects', App\Http\Controllers\ProjectController::class);
        Route::resource('trip-details', App\Http\Controllers\TripDetailController::class);
    });

    // Routes for password change
    Route::get('/password/change', [App\Http\Controllers\Auth\ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [App\Http\Controllers\Auth\ChangePasswordController::class, 'changePassword'])->name('password.update');
});

// Delete selected routes
Route::delete('employees.deleteSelected', [EmployeeController::class, 'deleteSelected'])->name('employees.deleteSelected');
Route::delete('vehicles.deleteSelected', [VehicleController::class, 'deleteSelected'])->name('vehicles.deleteSelected');
Route::delete('projects.deleteSelected', [App\Http\Controllers\ProjectController::class, 'deleteSelected'])->name('projects.deleteSelected');
Route::delete('trips.deleteSelected', [App\Http\Controllers\TripController::class, 'deleteSelected'])->name('trips.deleteSelected');
Route::delete('insurances.deleteSelected', [App\Http\Controllers\InsuranceController::class, 'deleteSelected'])->name('insurances.deleteSelected');

// Export CSV route for employees
Route::get('/employees/{id}/export-csv', [EmployeeController::class, 'exportCsv'])->name('employees.exportCsv');

// Get districts by country
Route::get('/districts/{country}', [DistrictController::class, 'getDistrictsByCountry']);

// Import employees routes
Route::post('employees-import', [EmployeeController::class, 'import'])->name('employee.import');
Route::post('/employees/importCsv', [EmployeeController::class, 'importCsv'])->name('employees.importCsv');

// Error 403 route
Route::get('/403', function () {
    return view('components.Errors.403');
})->name('error.403');
