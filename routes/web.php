<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/run-migrations', function () {
    Artisan::call('migrate:fresh ----force');
    return 'Migrations have been run';
});