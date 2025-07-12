<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Audit\PerencanaanAuditController;

// Audit Routes
Route::prefix('audit')->name('audit.')->group(function () {
    // Perencanaan Audit
    Route::resource('perencanaan', PerencanaanAuditController::class);
}); 