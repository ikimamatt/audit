@php
    $auditors = $auditors ?? collect();
    $auditees = $auditees ?? collect();
@endphp
@extends('layouts.vertical', ['title' => 'Tambah Perencanaan Audit'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title mb-0">TAMBAH PERENCANAAN AUDIT</h4>
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
                <form id="form-perencanaan-audit" method="POST" action="{{ route('audit.perencanaan.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tanggal Surat Tugas</label>
                        <input type="date" name="tanggal_surat_tugas" class="form-control" value="{{ old('tanggal_surat_tugas') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat Tugas</label>
                        <input type="text" name="nomor_surat_tugas" class="form-control" value="{{ old('nomor_surat_tugas') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Audit</label>
                        <select name="jenis_audit" class="form-select" required>
                            <option value="">Pilih Jenis Audit</option>
                            <option value="Operasional" {{ old('jenis_audit') == 'Operasional' ? 'selected' : '' }}>Operasional - SPI.01.02</option>
                            <option value="Khusus" {{ old('jenis_audit') == 'Khusus' ? 'selected' : '' }}>Khusus - SPI.01.03</option>
                            <option value="Konsultan" {{ old('jenis_audit') == 'Konsultan' ? 'selected' : '' }}>Konsultan - SPI.01.04</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Auditor</label>
                        <div id="auditor-list">
                            @php $auditorList = old('auditor', ['']); @endphp
                            @foreach($auditorList as $i => $aud)
                            <div class="input-group mb-2 auditor-item">
                                <input type="text" name="auditor[]" class="form-control" placeholder="Nama Auditor dan NIP" value="{{ $aud }}" required>
                                <button type="button" class="btn btn-danger btn-remove-auditor" @if($i==0) style="display:none" @endif>-</button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-info" id="btn-add-auditor">Tambah Auditor</button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Auditee</label>
                        <select name="auditee" class="form-select" required>
                            <option value="">Pilih Auditee</option>
                            @foreach($auditees as $auditee)
                                <option value="{{ $auditee->id }}" {{ old('auditee') == $auditee->id ? 'selected' : '' }}>{{ $auditee->direktorat }} - {{ $auditee->divisi_cabang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ruang Lingkup</label>
                        <div id="ruang-lingkup-list">
                            @php $ruangLingkup = old('ruang_lingkup', ['']); @endphp
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
                            <input type="date" name="tanggal_audit_mulai" class="form-control" value="{{ old('tanggal_audit_mulai') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Audit (sampai)</label>
                            <input type="date" name="tanggal_audit_sampai" class="form-control" value="{{ old('tanggal_audit_sampai') }}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label">Periode Audit (awal)</label>
                            <input type="text" name="periode_awal" class="form-control" value="{{ old('periode_awal') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Periode Audit (akhir)</label>
                            <input type="text" name="periode_akhir" class="form-control" value="{{ old('periode_akhir') }}" required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('audit.perencanaan.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
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
</script>
@endsection 
