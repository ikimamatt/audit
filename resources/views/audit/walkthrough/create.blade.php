@extends('layouts.vertical', ['title' => 'Tambah Walkthrough Audit'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Tambah Walkthrough Audit</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('audit.walkthrough.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="perencanaan_audit_id" class="form-label">Surat Tugas Audit</label>
                        <select name="perencanaan_audit_id" id="perencanaan_audit_id" class="form-control" required>
                            <option value="">Pilih Surat Tugas</option>
                            @foreach($suratTugas as $st)
                                <option value="{{ $st->id }}">{{ $st->nomor_surat_tugas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_walkthrough" class="form-label">Tanggal Walkthrough</label>
                        <input type="date" name="tanggal_walkthrough" id="tanggal_walkthrough" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="auditee_nama" class="form-label">Nama Auditee</label>
                        <input type="text" name="auditee_nama" id="auditee_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="hasil_walkthrough" class="form-label">Hasil Walkthrough</label>
                        <textarea name="hasil_walkthrough" id="hasil_walkthrough" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('audit.walkthrough.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 