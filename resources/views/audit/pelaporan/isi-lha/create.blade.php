@extends('layouts.vertical', ['title' => 'Tambah ISI LHA/LHK'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title mb-0">Tambah ISI LHA/LHK</h4>
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
                <form method="POST" action="{{ route('audit.isi-lha.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul LHA/LHK</label>
                        <select name="pelaporan_hasil_audit_id" id="judul_lha_lhk" class="form-select" required>
                            <option value="">Pilih Judul LHA/LHK</option>
                            @foreach($judulLhaLhk as $judul)
                                <option value="{{ $judul->id }}" data-nomor-iss="{{ $judul->nomor_iss }}">
                                    {{ $judul->nomor_lha_lhk }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor ISS</label>
                        <input type="text" id="nomor_iss" name="nomor_iss" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permasalahan <span class="text-muted">(max 1000 karakter)</span></label>
                        <textarea name="permasalahan" class="form-control" rows="3" maxlength="1000" required>{{ old('permasalahan') }}</textarea>
                        <div class="form-text text-end">
                            <span id="permasalahan-count">0</span>/1000
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penyebab <span class="text-muted">(max 1000 karakter)</span></label>
                        <textarea name="penyebab" class="form-control" rows="3" maxlength="1000" required>{{ old('penyebab') }}</textarea>
                        <div class="form-text text-end">
                            <span id="penyebab-count">0</span>/1000
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kriteria <span class="text-muted">(max 1000 karakter)</span></label>
                        <textarea name="kriteria" class="form-control" rows="3" maxlength="1000" required>{{ old('kriteria') }}</textarea>
                        <div class="form-text text-end">
                            <span id="kriteria-count">0</span>/1000
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dampak yang telah terjadi <span class="text-muted">(max 1000 karakter)</span></label>
                        <textarea name="dampak_terjadi" class="form-control" rows="3" maxlength="1000">{{ old('dampak_terjadi') }}</textarea>
                        <div class="form-text text-end">
                            <span id="dampak_terjadi-count">0</span>/1000
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dampak yang berpotensi terjadi <span class="text-muted">(max 1000 karakter)</span></label>
                        <textarea name="dampak_potensi" class="form-control" rows="3" maxlength="1000">{{ old('dampak_potensi') }}</textarea>
                        <div class="form-text text-end">
                            <span id="dampak_potensi-count">0</span>/1000
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Signifikansi</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="signifikansi" id="signifikansi_tinggi" value="Tinggi" {{ old('signifikansi') == 'Tinggi' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="signifikansi_tinggi">
                                <span class="badge bg-danger">Tinggi</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="signifikansi" id="signifikansi_medium" value="Medium" {{ old('signifikansi') == 'Medium' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="signifikansi_medium">
                                <span class="badge bg-warning">Medium</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="signifikansi" id="signifikansi_rendah" value="Rendah" {{ old('signifikansi') == 'Rendah' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="signifikansi_rendah">
                                <span class="badge bg-success">Rendah</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
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

    // Character counter for textareas
    const textareas = ['permasalahan', 'penyebab', 'kriteria', 'dampak_terjadi', 'dampak_potensi'];
    textareas.forEach(function(fieldName) {
        const textarea = document.querySelector(`textarea[name="${fieldName}"]`);
        const counter = document.getElementById(`${fieldName}-count`);
        
        if (textarea && counter) {
            // Set initial count
            counter.textContent = textarea.value.length;
            
            // Update count on input
            textarea.addEventListener('input', function() {
                counter.textContent = this.value.length;
            });
        }
    });
});
</script>
@endsection 