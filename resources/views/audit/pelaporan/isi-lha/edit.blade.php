@extends('layouts.vertical', ['title' => 'Edit ISI LHA/LHK'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title mb-0">Edit ISI LHA/LHK</h4>
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
                <form method="POST" action="{{ route('audit.isi-lha.update', $data->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Judul LHA/LHK</label>
                        <select name="pelaporan_hasil_audit_id" id="judul_lha_lhk" class="form-select" required>
                            <option value="">Pilih Judul LHA/LHK</option>
                            @foreach($judulLhaLhk as $judul)
                                <option value="{{ $judul->id }}" data-nomor-iss="{{ $judul->nomor_iss }}" {{ old('pelaporan_hasil_audit_id', $data->pelaporan_hasil_audit_id) == $judul->id ? 'selected' : '' }}>
                                    {{ $judul->nomor_lha_lhk }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor ISS</label>
                        <input type="text" id="nomor_iss" name="nomor_iss" class="form-control" value="{{ old('nomor_iss', $data->nomor_iss) }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permasalahan</label>
                        <textarea name="permasalahan" class="form-control" rows="3" required>{{ old('permasalahan', $data->permasalahan) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penyebab</label>
                        <textarea name="penyebab" class="form-control" rows="3" required>{{ old('penyebab', $data->penyebab) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kriteria</label>
                        <textarea name="kriteria" class="form-control" rows="3" required>{{ old('kriteria', $data->kriteria) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dampak</label>
                        <textarea name="dampak" class="form-control" rows="3" required>{{ old('dampak', $data->dampak) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Signifikansi</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="signifikansi" id="signifikansi_tinggi" value="Tinggi" {{ old('signifikansi', $data->signifikansi) == 'Tinggi' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="signifikansi_tinggi">
                                <span class="badge bg-danger">Tinggi</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="signifikansi" id="signifikansi_medium" value="Medium" {{ old('signifikansi', $data->signifikansi) == 'Medium' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="signifikansi_medium">
                                <span class="badge bg-warning">Medium</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="signifikansi" id="signifikansi_rendah" value="Rendah" {{ old('signifikansi', $data->signifikansi) == 'Rendah' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="signifikansi_rendah">
                                <span class="badge bg-success">Rendah</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('audit.isi-lha.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const judulSelect = document.getElementById('judul_lha_lhk');
    const nomorIssInput = document.getElementById('nomor_iss');

    judulSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const nomorIss = selectedOption.getAttribute('data-nomor-iss');
        nomorIssInput.value = nomorIss || '';
    });
});
</script>
@endsection 