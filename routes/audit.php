<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Audit\PerencanaanAuditController;

// Audit Routes
Route::prefix('audit')->name('audit.')->group(function () {
    // Perencanaan Audit
    Route::resource('perencanaan', PerencanaanAuditController::class);
    Route::resource('pka', \App\Http\Controllers\Http\Controllers\Audit\ProgramKerjaAuditController::class);
    Route::post('pka/{pka}/dokumen/{dok}/approval', [\App\Http\Controllers\Http\Controllers\Audit\ProgramKerjaAuditController::class, 'approval'])->name('pka.approval');
    Route::resource('pkpt', \App\Http\Controllers\Http\Controllers\Audit\JadwalPkptAuditController::class);
    Route::post('pkpt/{pkpt}/approval', [\App\Http\Controllers\Http\Controllers\Audit\JadwalPkptAuditController::class, 'approval'])->name('pkpt.approval');

    // Dashboard PKPT
    Route::get('dashboard-pkpt', [\App\Http\Controllers\Audit\DashboardPkptController::class, 'index'])->name('dashboard-pkpt.index');
});
