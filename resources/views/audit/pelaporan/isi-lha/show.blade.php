@extends('layouts.vertical', ['title' => 'Detail ISI LHA/LHK'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title mb-0">Detail ISI LHA/LHK</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Judul LHA/LHK:</label>
                        <p class="form-control-plaintext">{{ $data->pelaporanHasilAudit->nomor_lha_lhk ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nomor ISS:</label>
                        <p class="form-control-plaintext">{{ $data->nomor_iss }}</p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Permasalahan:</label>
                    <div class="form-control-plaintext" style="min-height: 80px; background-color: #f8f9fa; padding: 10px; border-radius: 5px;">
                        {{ $data->permasalahan }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Penyebab:</label>
                    <div class="form-control-plaintext" style="min-height: 80px; background-color: #f8f9fa; padding: 10px; border-radius: 5px;">
                        {{ $data->penyebab }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Kriteria:</label>
                    <div class="form-control-plaintext" style="min-height: 80px; background-color: #f8f9fa; padding: 10px; border-radius: 5px;">
                        {{ $data->kriteria }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Dampak yang Terjadi:</label>
                    <div class="form-control-plaintext" style="min-height: 80px; background-color: #f8f9fa; padding: 10px; border-radius: 5px;">
                        {{ $data->dampak_terjadi ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Dampak Potensial:</label>
                    <div class="form-control-plaintext" style="min-height: 80px; background-color: #f8f9fa; padding: 10px; border-radius: 5px;">
                        {{ $data->dampak_potensi ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Signifikansi:</label>
                    <div class="form-control-plaintext">
                        @if($data->signifikansi == 'Tinggi')
                            <span class="badge bg-danger">Tinggi</span>
                        @elseif($data->signifikansi == 'Medium')
                            <span class="badge bg-warning">Medium</span>
                        @elseif($data->signifikansi == 'Rendah')
                            <span class="badge bg-success">Rendah</span>
                        @else
                            <span class="badge bg-secondary">{{ $data->signifikansi ?? '-' }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status Approval:</label>
                        <p class="form-control-plaintext">
                            @if($data->status_approval == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($data->status_approval == 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Approved By:</label>
                        <p class="form-control-plaintext">{{ $data->approver->nama ?? '-' }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Created At:</label>
                        <p class="form-control-plaintext">{{ $data->created_at ? $data->created_at->format('d/m/Y H:i') : '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Updated At:</label>
                        <p class="form-control-plaintext">{{ $data->updated_at ? $data->updated_at->format('d/m/Y H:i') : '-' }}</p>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('audit.isi-lha.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('audit.isi-lha.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 