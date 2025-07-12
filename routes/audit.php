<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Audit\PerencanaanAuditController;
use App\Http\Controllers\Audit\ToeAuditController;
use App\Http\Controllers\Audit\ToeEvaluasiController;
use App\Http\Controllers\Audit\EntryMeetingController;

// Audit Routes
Route::prefix('audit')->name('audit.')->group(function () {
    // Perencanaan Audit
    Route::resource('perencanaan', PerencanaanAuditController::class);
    Route::resource('pka', \App\Http\Controllers\Http\Controllers\Audit\ProgramKerjaAuditController::class);
    Route::post('pka/{pka}/dokumen/{dok}/approval', [\App\Http\Controllers\Http\Controllers\Audit\ProgramKerjaAuditController::class, 'approval'])->name('pka.approval');
    Route::resource('pkpt', \App\Http\Controllers\Http\Controllers\Audit\JadwalPkptAuditController::class);
    Route::post('pkpt/{pkpt}/approval', [\App\Http\Controllers\Http\Controllers\Audit\JadwalPkptAuditController::class, 'approval'])->name('pkpt.approval');
    Route::resource('walkthrough', \App\Http\Controllers\Audit\WalkthroughAuditController::class);
    Route::post('walkthrough/{walkthrough}/approval', [\App\Http\Controllers\Audit\WalkthroughAuditController::class, 'approval'])->name('walkthrough.approval');
    Route::resource('tod-bpm', \App\Http\Controllers\Audit\TodBpmAuditController::class);
    Route::post('tod-bpm/{tod_bpm}/approval', [\App\Http\Controllers\Audit\TodBpmAuditController::class, 'approval'])->name('tod-bpm.approval');
    Route::resource('tod-bpm-evaluasi', \App\Http\Controllers\Audit\TodBpmEvaluasiController::class);
    Route::get('tod-bpm-evaluasi-modal/{bpmId}', [\App\Http\Controllers\Audit\TodBpmEvaluasiController::class, 'modal'])->name('tod-bpm-evaluasi.modal');

    // TOE Audit
    Route::resource('toe', ToeAuditController::class);
    Route::post('toe/{id}/approval', [ToeAuditController::class, 'approval'])->name('toe.approval');

    // TOE Evaluasi
    Route::get('toe-evaluasi', [ToeEvaluasiController::class, 'index'])->name('toe-evaluasi.index');
    Route::post('toe-evaluasi', [ToeEvaluasiController::class, 'store'])->name('toe-evaluasi.store');
    Route::put('toe-evaluasi/{id}', [ToeEvaluasiController::class, 'update'])->name('toe-evaluasi.update');
    Route::delete('toe-evaluasi/{id}', [ToeEvaluasiController::class, 'destroy'])->name('toe-evaluasi.destroy');
    Route::get('toe-evaluasi-modal/{toeId}', [ToeEvaluasiController::class, 'modal'])->name('toe-evaluasi.modal');

    // Entry Meeting
    Route::resource('entry-meeting', EntryMeetingController::class);
    Route::post('entry-meeting/{id}/approval', [EntryMeetingController::class, 'approval'])->name('entry-meeting.approval');

    // Pelaporan Hasil Audit
    Route::resource('pelaporan-hasil-audit', \App\Http\Controllers\Audit\PelaporanHasilAuditController::class);
    Route::post('pelaporan-hasil-audit/{id}/approval', [\App\Http\Controllers\Audit\PelaporanHasilAuditController::class, 'approval'])->name('pelaporan-hasil-audit.approval');
    // Pelaporan Temuan
    Route::resource('pelaporan-temuan', \App\Http\Controllers\Audit\PelaporanTemuanController::class);
    Route::post('pelaporan-temuan/{id}/approval', [\App\Http\Controllers\Audit\PelaporanTemuanController::class, 'approval'])->name('pelaporan-temuan.approval');

    // ISI LHA/LHK
    Route::resource('isi-lha', \App\Http\Controllers\Audit\PelaporanIsiLhaController::class);
    Route::get('isi-lha/get-nomor-iss/{id}', [\App\Http\Controllers\Audit\PelaporanIsiLhaController::class, 'getNomorIss'])->name('isi-lha.get-nomor-iss');
    Route::post('isi-lha/{id}/approval', [\App\Http\Controllers\Audit\PelaporanIsiLhaController::class, 'approval'])->name('isi-lha.approval');

    // Dashboard PKPT
    Route::get('dashboard-pkpt', [\App\Http\Controllers\Audit\DashboardPkptController::class, 'index'])->name('dashboard-pkpt.index');
});
