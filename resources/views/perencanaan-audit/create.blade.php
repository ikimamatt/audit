@extends('layouts.vertical', ['title' => 'Tambah Program Kerja Audit'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title mb-0">CREATE PROGRAM KERJA AUDIT</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('audit.pka.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Surat Tugas</label>
                        <select name="perencanaan_audit_id" class="form-select" required>
                            <option value="">Pilih Surat Tugas</option>
                            @foreach($suratTugas as $st)
                                <option value="{{ $st->id }}">{{ $st->nomor_surat_tugas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal PKA</label>
                        <input type="date" name="tanggal_pka" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No PKA</label>
                        <input type="text" name="no_pka" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Informasi Umum</label>
                        <textarea name="informasi_umum" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">KPI Tidak Tercapai</label>
                        <textarea name="kpi_tidak_tercapai" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data Awal Dokumen Audit</label>
                        <textarea name="data_awal_dokumen" class="form-control"></textarea>
                    </div>
                    <!-- Risk Based Audit -->
                    <div class="mb-3">
                        <label class="form-label">Risk Based Audit</label>
                        <div id="risk-list">
                            <!-- Dynamic risk input, JS akan menambah/menghapus -->
                        </div>
                        <button type="button" class="btn btn-sm btn-info" id="btn-add-risk">Tambah Risk</button>
                    </div>
                    <!-- Milestone -->
                    <div class="mb-3">
                        <label class="form-label">Milestone</label>
                        @php
                        $milestones = ['Entry Meeting', 'Walkthrough', 'TOD', 'TOE', 'Draf LHA', 'Exit Meeting'];
                        @endphp
                        <div class="row">
                            @foreach($milestones as $m)
                            <div class="col-md-6 mb-2">
                                <div class="card p-2">
                                    <strong>{{ $m }}</strong>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">Mulai</label>
                                            <input type="date" name="milestone[{{ $m }}][mulai]" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Selesai</label>
                                            <input type="date" name="milestone[{{ $m }}][selesai]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Upload Dokumen -->
                    <div class="mb-3">
                        <label class="form-label">Upload Dokumen PKA</label>
                        <input type="file" name="dokumen[]" class="form-control" multiple>
                    </div>
                    <!-- Approval akan diimplementasikan selanjutnya -->
                    <div class="mb-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('audit.pka.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
// Dynamic Risk Based Audit
let riskIndex = 0;
function riskInput(idx, data = {}) {
    return `<div class='card mb-2 p-2 risk-item'>
        <div class='row'>
            <div class='col-md-3'>
                <label class='form-label'>Deskripsi Risiko</label>
                <textarea name='risk[${idx}][deskripsi_resiko]' class='form-control' placeholder='Deskripsi Risiko' required>${data.deskripsi_resiko||''}</textarea>
            </div>
            <div class='col-md-2'>
                <label class='form-label'>Penyebab Risiko</label>
                <textarea name='risk[${idx}][penyebab_resiko]' class='form-control' placeholder='Penyebab Risiko' required>${data.penyebab_resiko||''}</textarea>
            </div>
            <div class='col-md-2'>
                <label class='form-label'>Dampak Risiko</label>
                <textarea name='risk[${idx}][dampak_resiko]' class='form-control' placeholder='Dampak Risiko' required>${data.dampak_resiko||''}</textarea>
            </div>
            <div class='col-md-3'>
                <label class='form-label'>Pengendalian Eksisting</label>
                <textarea name='risk[${idx}][pengendalian_eksisting]' class='form-control' placeholder='Pengendalian Eksisting' required>${data.pengendalian_eksisting||''}</textarea>
            </div>
            <div class='col-md-2 d-flex align-items-end'>
                <button type='button' class='btn btn-danger btn-remove-risk'>Hapus</button>
            </div>
        </div>
    </div>`;
}
$(document).on('click', '#btn-add-risk', function() {
    $('#risk-list').append(riskInput(riskIndex++));
});
$(document).on('click', '.btn-remove-risk', function() {
    $(this).closest('.risk-item').remove();
});
</script>
@endsection 