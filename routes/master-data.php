<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterData\MasterKodeAoiController;
use App\Http\Controllers\MasterData\MasterKodeRiskController;
use App\Http\Controllers\MasterData\MasterAuditeeController;
use App\Http\Controllers\MasterData\MasterUserController;
use App\Http\Controllers\MasterData\MasterAksesUserController;

// Master Data Routes
Route::prefix('master')->name('master.')->group(function () {
    // Kode AOI
    Route::get('kode-aoi', [MasterKodeAoiController::class, 'index'])->name('kode-aoi.index');
    
    // Kode Risk
    Route::get('kode-risk', [MasterKodeRiskController::class, 'index'])->name('kode-risk.index');
    
    // Auditee
    Route::get('auditee', [MasterAuditeeController::class, 'index'])->name('auditee.index');
    
    // User
    Route::get('user', [MasterUserController::class, 'index'])->name('user.index');
    
    // Akses User
    Route::get('akses-user', [MasterAksesUserController::class, 'index'])->name('akses-user.index');
}); 