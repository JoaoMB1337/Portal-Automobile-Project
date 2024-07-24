<?php
use App\Http\Controllers\Auth\TwoFactorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\CostReportController;
use App\Http\Controllers\ExternalCarReportController;
use App\Http\Controllers\ProjectReportController;
use App\Http\Controllers\InsuranceReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Middleware\EnsureTwoFactorEnabled;
use App\Http\Middleware\NoCacheMiddleware;
use App\Http\Middleware\EnsureTwoFactorSetup;
use App\Http\Middleware\PreventAccessTo2FASetup;
use App\Http\Middleware\CheckValid2FA;

// Middleware para prevenir cache em rotas sensíveis
Route::middleware([NoCacheMiddleware::class])->group(function () {
    Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login.form');
    Auth::routes(['register' => false]);

    Route::middleware(['auth', PreventAccessTo2FASetup::class])->group(function () {
        Route::get('/2fa/setup', [TwoFactorController::class, 'setup'])->name('2fa.setup');
        Route::post('/2fa/setup', [TwoFactorController::class, 'completeSetup'])->name('2fa.completeSetup');
    });
    Route::middleware(['auth'])->group(function () {
        Route::get('/2fa', [TwoFactorController::class, 'showVerifyForm'])->name('2fa.verify');
        Route::post('/2fa', [TwoFactorController::class, 'verify'])->name('2fa.verifyForm');
        Route::put('/employees/{employee}/reset2fa', [TwoFactorController::class, 'reset2FA'])->name('employees.reset2fa');
    });
});

// Middleware para proteger rotas autenticadas e 2FA
Route::middleware(['auth', EnsureTwoFactorEnabled::class, NoCacheMiddleware::class, CheckValid2FA::class])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/vehicles/{vehicle}/download-pdf', [VehicleController::class, 'downloadPdf'])->name('vehicles.downloadPdf');
    Route::resource('employees', EmployeeController::class);
    Route::resource('trips', TripController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('insurances', App\Http\Controllers\InsuranceController::class);
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::resource('trip-details', App\Http\Controllers\TripDetailController::class);
    // Routes for password change
    Route::get('/password/change', [App\Http\Controllers\Auth\ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [App\Http\Controllers\Auth\ChangePasswordController::class, 'changePassword'])->name('password.change.update');
});

// Rotas de exclusão em massa
Route::delete('employees.deleteSelected', [EmployeeController::class, 'deleteSelected'])->name('employees.deleteSelected');
Route::delete('vehicles.deleteSelected', [VehicleController::class, 'deleteSelected'])->name('vehicles.deleteSelected');
Route::delete('projects.deleteSelected', [App\Http\Controllers\ProjectController::class, 'deleteSelected'])->name('projects.deleteSelected');
Route::delete('trips.deleteSelected', [App\Http\Controllers\TripController::class, 'deleteSelected'])->name('trips.deleteSelected');
Route::delete('insurances.deleteSelected', [App\Http\Controllers\InsuranceController::class, 'deleteSelected'])->name('insurances.deleteSelected');

Route::get('/employees/{id}/export-csv', [EmployeeController::class, 'exportCsv'])->name('employees.exportCsv');

Route::get('/districts/{country}', [App\Http\Controllers\DistrictController::class, 'getDistrictsByCountry']);

Route::post('employees-import', [EmployeeController::class, 'import'])->name('employee.import');
Route::post('/employees/importCsv', [EmployeeController::class, 'importCsv'])->name('employees.importCsv');

Route::get('/403', function () {
    return view('components.Errors.403');
})->name('error.403');

Route::get('/file-not-found', function () {
    return view('components.Errors.file_not_found');
})->name('file.not.found');

Route::get('/cost-report', [CostReportController::class, 'index'])->name('cost.report.index');
Route::post('/cost-report', [CostReportController::class, 'filter'])->name('cost.report.filter');
Route::get('/cost-report/generate', [CostReportController::class, 'generateCostReport'])->name('cost.report.generate');

Route::get('/external-car-report', [ExternalCarReportController::class, 'index'])->name('external.car.report.index');
Route::post('/external-car-report', [ExternalCarReportController::class, 'filter'])->name('external.car.report.filter');
Route::get('/external-car-report/generate', [ExternalCarReportController::class, 'generateExternalCarReport'])->name('external.car.report.generate');

Route::get('/project-reports', [ProjectReportController::class, 'index'])->name('project.report.index');
Route::post('/project-reports', [ProjectReportController::class, 'filter'])->name('project.report.filter');
Route::get('/project-reports/generate', [ProjectReportController::class, 'generateProjectReport'])->name('project.report.generate');

Route::get('/insurance-reports', [InsuranceReportController::class, 'index'])->name('insurance.report.index');
Route::post('/insurance-reports', [InsuranceReportController::class, 'filter'])->name('insurance.report.filter');
Route::get('/insurance-reports/generate', [InsuranceReportController::class, 'generateInsuranceReport'])->name('insurance.report.generate');

Route::get('api/check-vehicle-availability', [TripController::class, 'checkVehicleAvailability']);
Route::get('/fetch-data', [HomeController::class, 'fetchData'])->name('fetch.data');
