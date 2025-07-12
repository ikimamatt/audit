@extends('layouts.vertical', ['title' => 'Edit Pelaporan Hasil Audit'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title mb-0">Edit Pelaporan Hasil Audit</h4>
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
                <form method="POST" action="{{ route('audit.pelaporan-hasil-audit.update', $item->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Surat Tugas Audit</label>
                        <select name="perencanaan_audit_id" class="form-select" required>
                            <option value="">Pilih Surat Tugas</option>
                            @foreach($suratTugas as $st)
                                <option value="{{ $st->id }}" {{ old('perencanaan_audit_id', $item->perencanaan_audit_id)==$st->id?'selected':'' }}>{{ $st->nomor_surat_tugas }} - {{ $st->auditee->direktorat ?? '' }} {{ $st->auditee->divisi_cabang ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor LHA/LHK</label>
                        <input type="text" name="nomor_lha_lhk" class="form-control" placeholder="xxx.AA/BB/CC/SPI.PCN/yyyy" required value="{{ old('nomor_lha_lhk', $item->nomor_lha_lhk) }}">
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label class="form-label">Jenis LHA/LHK</label>
                            <select name="jenis_lha_lhk" class="form-select" required>
                                <option value="">Pilih Jenis</option>
                                <option value="LHA" {{ old('jenis_lha_lhk', $item->jenis_lha_lhk)=='LHA'?'selected':'' }}>LHA</option>
                                <option value="LHK" {{ old('jenis_lha_lhk', $item->jenis_lha_lhk)=='LHK'?'selected':'' }}>LHK</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">PO/KONSUL</label>
                            <select name="po_audit_konsul" class="form-select" required>
                                <option value="">Pilih</option>
                                <option value="PO AUDIT" {{ old('po_audit_konsul', $item->po_audit_konsul)=='PO AUDIT'?'selected':'' }}>PO AUDIT</option>
                                <option value="KONSUL" {{ old('po_audit_konsul', $item->po_audit_konsul)=='KONSUL'?'selected':'' }}>KONSUL</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kode SPI</label>
                            <select name="kode_spi" class="form-select" required>
                                <option value="">Pilih</option>
                                <option value="SPI.01.02" {{ old('kode_spi', $item->kode_spi)=='SPI.01.02'?'selected':'' }}>SPI.01.02</option>
                                <option value="SPI.01.03" {{ old('kode_spi', $item->kode_spi)=='SPI.01.03'?'selected':'' }}>SPI.01.03</option>
                                <option value="SPI.01.04" {{ old('kode_spi', $item->kode_spi)=='SPI.01.04'?'selected':'' }}>SPI.01.04</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control" placeholder="2024" required value="{{ old('tahun', $item->tahun) }}">
                    </div>
                    <div class="mb-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('audit.pelaporan-hasil-audit.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 