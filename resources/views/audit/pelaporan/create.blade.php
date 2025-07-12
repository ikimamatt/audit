@extends('layouts.vertical', ['title' => 'Tambah Pelaporan Hasil Audit'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title mb-0">Tambah Pelaporan Hasil Audit</h4>
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
                <form method="POST" action="{{ route('audit.pelaporan-hasil-audit.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Surat Tugas Audit</label>
                        <select name="perencanaan_audit_id" class="form-select" required>
                            <option value="">Pilih Surat Tugas</option>
                            @foreach($suratTugas as $st)
                                <option value="{{ $st->id }}">{{ $st->nomor_surat_tugas }} - {{ $st->auditee->direktorat ?? '' }} {{ $st->auditee->divisi_cabang ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor LHA/LHK</label>
                        <input type="text" name="nomor_lha_lhk" class="form-control" placeholder="xxx.AA/BB/CC/SPI.PCN/yyyy" required value="{{ old('nomor_lha_lhk') }}">
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label class="form-label">Jenis LHA/LHK</label>
                            <select name="jenis_lha_lhk" class="form-select" required>
                                <option value="">Pilih Jenis</option>
                                <option value="LHA" {{ old('jenis_lha_lhk')=='LHA'?'selected':'' }}>LHA</option>
                                <option value="LHK" {{ old('jenis_lha_lhk')=='LHK'?'selected':'' }}>LHK</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">PO/KONSUL</label>
                            <select name="po_audit_konsul" class="form-select" required>
                                <option value="">Pilih</option>
                                <option value="PO AUDIT" {{ old('po_audit_konsul')=='PO AUDIT'?'selected':'' }}>PO AUDIT</option>
                                <option value="KONSUL" {{ old('po_audit_konsul')=='KONSUL'?'selected':'' }}>KONSUL</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kode SPI</label>
                            <select name="kode_spi" class="form-select" required>
                                <option value="">Pilih</option>
                                <option value="SPI.01.02" {{ old('kode_spi')=='SPI.01.02'?'selected':'' }}>SPI.01.02</option>
                                <option value="SPI.01.03" {{ old('kode_spi')=='SPI.01.03'?'selected':'' }}>SPI.01.03</option>
                                <option value="SPI.01.04" {{ old('kode_spi')=='SPI.01.04'?'selected':'' }}>SPI.01.04</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control" placeholder="2024" required value="{{ old('tahun') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor ISS</label>
                        <input type="text" name="nomor_iss" class="form-control" placeholder="ISS.xxx/PO PCN/MM/NN/PP/yyyy" required value="{{ old('nomor_iss') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permasalahan / Kondisi</label>
                        <textarea name="permasalahan" class="form-control" maxlength="5000" rows="3" required>{{ old('permasalahan') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penyebab</label>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label class="form-label">People</label>
                                <textarea name="penyebab_people" class="form-control" maxlength="1000" rows="2">{{ old('penyebab_people') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Process</label>
                                <textarea name="penyebab_process" class="form-control" maxlength="1000" rows="2">{{ old('penyebab_process') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Policy</label>
                                <textarea name="penyebab_policy" class="form-control" maxlength="1000" rows="2">{{ old('penyebab_policy') }}</textarea>
                            </div>
                        </div>
                        <div class="row g-2 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">System</label>
                                <textarea name="penyebab_system" class="form-control" maxlength="1000" rows="2">{{ old('penyebab_system') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Eksternal</label>
                                <textarea name="penyebab_eksternal" class="form-control" maxlength="1000" rows="2">{{ old('penyebab_eksternal') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kriteria / Sumber</label>
                        <textarea name="kriteria" class="form-control" maxlength="5000" rows="3">{{ old('kriteria') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dampak</label>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label">Dampak yang telah terjadi</label>
                                <textarea name="dampak_terjadi" class="form-control" maxlength="1000" rows="2">{{ old('dampak_terjadi') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Dampak yang berpotensi terjadi</label>
                                <textarea name="dampak_potensi" class="form-control" maxlength="1000" rows="2">{{ old('dampak_potensi') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Signifikan</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="signifikan" id="signifikanTinggi" value="Tinggi" {{ old('signifikan')=='Tinggi'?'checked':'' }} required>
                            <label class="form-check-label" for="signifikanTinggi">Tinggi</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="signifikan" id="signifikanMedium" value="Medium" {{ old('signifikan')=='Medium'?'checked':'' }}>
                            <label class="form-check-label" for="signifikanMedium">Medium</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="signifikan" id="signifikanRendah" value="Rendah" {{ old('signifikan')=='Rendah'?'checked':'' }}>
                            <label class="form-check-label" for="signifikanRendah">Rendah</label>
                        </div>
                    </div>
                    <div class="mb-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('audit.pelaporan-hasil-audit.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 