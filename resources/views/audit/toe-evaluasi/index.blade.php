@extends('layouts.vertical', ['title' => 'Evaluasi TOE'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Evaluasi TOE</h4>
            <div class="mb-2">
                <strong>Judul BPM:</strong> {{ $toe->judul_bpm }}<br>
                <a href="{{ route('audit.toe.index') }}" class="btn btn-secondary btn-sm mt-2">Kembali ke List TOE</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('audit.toe-evaluasi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="toe_audit_id" value="{{ $toe->id }}">
                    <div class="mb-3">
                        <label for="hasil_evaluasi" class="form-label">Tambah Hasil Evaluasi TOE</label>
                        <textarea name="hasil_evaluasi" id="hasil_evaluasi" class="form-control" rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Evaluasi</button>
                </form>
                <hr>
                <h5>Daftar Hasil Evaluasi</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hasil Evaluasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($toe->evaluasi as $i => $ev)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>
                                @if(request('edit') == $ev->id)
                                    <form action="{{ route('toe-evaluasi.update', $ev->id) }}" method="POST" style="display:inline-block">
                                        @csrf @method('PUT')
                                        <textarea name="hasil_evaluasi" class="form-control" rows="2" required>{{ $ev->hasil_evaluasi }}</textarea>
                                        <button type="submit" class="btn btn-success btn-sm mt-1">Simpan</button>
                                        <a href="{{ route('audit.toe-evaluasi.index', ['toe_audit_id' => $toe->id]) }}" class="btn btn-secondary btn-sm mt-1">Batal</a>
                                    </form>
                                @else
                                    {{ $ev->hasil_evaluasi }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('audit.toe-evaluasi.index', ['toe_audit_id' => $toe->id, 'edit' => $ev->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('toe-evaluasi.destroy', $ev->id) }}" method="POST" style="display:inline-block" class="delete-form">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="toe_audit_id" value="{{ $toe->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete-swal">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete-swal').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = btn.closest('form');

                Swal.fire({
                    title: 'Hapus Evaluasi?',
                    text: 'Yakin ingin menghapus evaluasi ini?',
                    icon: 'warning',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection 