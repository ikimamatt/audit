@php
    $auditors = $auditors ?? collect();
    $auditees = $auditees ?? collect();
@endphp
@extends('layouts.vertical', ['title' => 'Perencanaan Audit'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title mb-0">PERENCANAAN AUDIT</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form id="form-perencanaan-audit" method="POST" action="{{ isset($item) ? route('audit.perencanaan.update', $item->id) : route('audit.perencanaan.store') }}">
                    @csrf
                    @if(isset($item)) @method('PUT') @endif
                    <div class="mb-3">
                        <label class="form-label">Tanggal Surat Tugas</label>
                        <input type="date" name="tanggal_surat_tugas" class="form-control" value="{{ old('tanggal_surat_tugas', $item->tanggal_surat_tugas ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat Tugas</label>
                        <input type="text" name="nomor_surat_tugas" class="form-control" value="{{ old('nomor_surat_tugas', $item->nomor_surat_tugas ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Audit</label>
                        <select name="jenis_audit" class="form-select" required>
                            <option value="">Pilih Jenis Audit</option>
                            <option value="Operasional" {{ old('jenis_audit', $item->jenis_audit ?? '') == 'Operasional' ? 'selected' : '' }}>Operasional - SPI.01.02</option>
                            <option value="Khusus" {{ old('jenis_audit', $item->jenis_audit ?? '') == 'Khusus' ? 'selected' : '' }}>Khusus - SPI.01.03</option>
                            <option value="Konsultan" {{ old('jenis_audit', $item->jenis_audit ?? '') == 'Konsultan' ? 'selected' : '' }}>Konsultan - SPI.01.04</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Auditor</label>
                        <div id="auditor-list">
                            @php $auditorList = old('auditor', isset($item) ? (is_array($item->auditor) ? $item->auditor : [$item->auditor]) : ['']); @endphp
                            @foreach($auditorList as $i => $aud)
                            <div class="input-group mb-2 auditor-item">
                                <input type="text" name="auditor[]" class="form-control" placeholder="Nama Auditor dan NIP" value="{{ $aud }}" required>
                                <button type="button" class="btn btn-danger btn-remove-auditor" @if($i==0) style="display:none" @endif>-</button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-info" id="btn-add-auditor">Tambah Auditor</button>
                        <!-- <small class="text-muted">Input manual nama dan NIP auditor. Bisa tambah lebih dari satu.</small> -->
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Auditee</label>
                        <select name="auditee" class="form-select" required>
                            <option value="">Pilih Auditee</option>
                            @foreach($auditees as $auditee)
                                <option value="{{ $auditee->id }}" {{ old('auditee', $item->auditee_id ?? '') == $auditee->id ? 'selected' : '' }}>{{ $auditee->direktorat }} - {{ $auditee->divisi_cabang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ruang Lingkup</label>
                        <div id="ruang-lingkup-list">
                            @php $ruangLingkup = old('ruang_lingkup', isset($item) ? (is_array($item->ruang_lingkup) ? $item->ruang_lingkup : [$item->ruang_lingkup]) : ['']); @endphp
                            @foreach($ruangLingkup as $i => $rl)
                            <div class="input-group mb-2 ruang-lingkup-item">
                                <input type="text" name="ruang_lingkup[]" class="form-control" value="{{ $rl }}" required>
                                <button type="button" class="btn btn-danger btn-remove-rl" @if($i==0) style="display:none" @endif>-</button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-info" id="btn-add-rl">Tambah Ruang Lingkup</button>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Audit (mulai)</label>
                            <input type="date" name="tanggal_audit_mulai" class="form-control" value="{{ old('tanggal_audit_mulai', $item->tanggal_audit_mulai ?? '') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Audit (sampai)</label>
                            <input type="date" name="tanggal_audit_sampai" class="form-control" value="{{ old('tanggal_audit_sampai', $item->tanggal_audit_sampai ?? '') }}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label">Periode Audit (awal)</label>
                            <input type="text" name="periode_awal" class="form-control" value="{{ old('periode_awal', $item->periode_awal ?? '') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Periode Audit (akhir)</label>
                            <input type="text" name="periode_akhir" class="form-control" value="{{ old('periode_akhir', $item->periode_akhir ?? '') }}" required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('audit.perencanaan.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
                <!-- Modal Notifikasi Surat Tugas -->
                <div class="modal fade" id="modalSuratTugas" tabindex="-1" aria-labelledby="modalSuratTugasLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="background: #4478c7; color: #fff; border-radius: 20px;">
                      <div class="modal-body text-center p-5">
                        <h5 class="mb-3" style="font-weight:600;">SURAT TUGAS</h5>
                        <div class="mb-4" style="font-size:1.2rem;">
                          {{ session('nomor') ?? (old('nomor_surat_tugas') ? old('nomor_surat_tugas') : ($item->nomor_surat_tugas ?? '001.STG/SPI.01.02/SPI-PCN/2025')) }}
                        </div>
                        <button type="button" class="btn" style="background:#f47c2b; color:#fff; min-width:100px;" data-bs-dismiss="modal">OK</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal Notifikasi Surat Tugas -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.getElementById('btn-add-rl').onclick = function() {
        var list = document.getElementById('ruang-lingkup-list');
        var item = document.createElement('div');
        item.className = 'input-group mb-2 ruang-lingkup-item';
        item.innerHTML = '<input type="text" name="ruang_lingkup[]" class="form-control" required> <button type="button" class="btn btn-danger btn-remove-rl">-</button>';
        list.appendChild(item);
        item.querySelector('.btn-remove-rl').onclick = function() { item.remove(); };
    };
    document.querySelectorAll('.btn-remove-rl').forEach(function(btn) {
        btn.onclick = function() { btn.closest('.ruang-lingkup-item').remove(); };
    });
    // Auditor dinamis
    document.getElementById('btn-add-auditor').onclick = function() {
        var list = document.getElementById('auditor-list');
        var item = document.createElement('div');
        item.className = 'input-group mb-2 auditor-item';
        item.innerHTML = '<input type="text" name="auditor[]" class="form-control" placeholder="Nama Auditor dan NIP" required> <button type="button" class="btn btn-danger btn-remove-auditor">-</button>';
        list.appendChild(item);
        item.querySelector('.btn-remove-auditor').onclick = function() { item.remove(); };
    };
    document.querySelectorAll('.btn-remove-auditor').forEach(function(btn) {
        btn.onclick = function() { btn.closest('.auditor-item').remove(); };
    });
    // Tampilkan modal jika ada session success atau sedang edit
    @if(session('success') || isset($item))
        var modal = new bootstrap.Modal(document.getElementById('modalSuratTugas'));
        window.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() { modal.show(); }, 300);
        });
    @endif
</script>
@endsection 
