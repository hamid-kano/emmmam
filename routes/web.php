<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientReportController;

Route::get('/', function () {
    return view('home');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', [PatientReportController::class, 'index'])->name('index');
    Route::get('/patient/{patient}', [PatientReportController::class, 'show'])->name('show');
    Route::get('/export', [PatientReportController::class, 'exportExcel'])->name('export');
});