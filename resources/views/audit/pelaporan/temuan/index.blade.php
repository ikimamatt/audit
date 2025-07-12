@extends('layouts.vertical', ['title' => 'Temuan Audit'])

@section('css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
     ])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Temuan Audit</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('audit.pelaporan-temuan.create') }}" class="btn btn-primary mb-3" style="display:none">
                    <i class="mdi mdi-plus-circle me-2"></i> Tambah Temuan Audit
                </a>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-centered w-100 dt-responsive nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Pelaporan</th>
                                <th>Hasil Temuan</th>
                                <th>Kode AOI</th>
                                <th>Kode Risiko</th>
                                <th>Nomor ISS</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->pelaporanHasilAudit->nomor_lha_lhk ?? '-' }}</td>
                                    <td>{{ $item->hasil_temuan }}</td>
                                    <td>{{ $item->kodeAoi->kode_area_of_improvement ?? '-' }} - {{ $item->kodeAoi->deskripsi_area_of_improvement ?? '-' }}</td>
                                    <td>{{ $item->kodeRisk->kode_risiko ?? '-' }} - {{ $item->kodeRisk->deskripsi_risiko ?? '-' }}</td>
                                    <td>{{ $item->nomor_iss }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>
                                        <a href="{{ route('audit.pelaporan-temuan.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="mdi mdi-pencil"></i> Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteData({{ $item->id }})"><i class="mdi mdi-delete"></i></button>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('audit.pelaporan-temuan.destroy', $item->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="9" class="text-center">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteData(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endsection 