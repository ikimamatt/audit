@extends('layouts.vertical', ['title' => 'Pelaporan Hasil Audit'])

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
            <h4 class="page-title">Pelaporan Hasil Audit</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('audit.pelaporan-hasil-audit.create') }}" class="btn btn-primary mb-3">
                    <i class="mdi mdi-plus-circle me-2"></i> Tambah Pelaporan Hasil Audit
                </a>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-centered w-100 dt-responsive nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Surat Tugas</th>
                                <th>Nomor LHA/LHK</th>
                                <th>Jenis</th>
                                <th>PO/Konsul</th>
                                <th>Kode SPI</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->perencanaanAudit->nomor_surat_tugas ?? '-' }}</td>
                                    <td>{{ $item->nomor_lha_lhk }}</td>
                                    <td>{{ $item->jenis_lha_lhk }}</td>
                                    <td>{{ $item->po_audit_konsul }}</td>
                                    <td>{{ $item->kode_spi }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>
                                        @if($item->status_approval == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($item->status_approval == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('audit.pelaporan-hasil-audit.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="mdi mdi-pencil"></i></a>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteData({{ $item->id }})"><i class="mdi mdi-delete"></i></button>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('audit.pelaporan-hasil-audit.destroy', $item->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{ route('audit.pelaporan-temuan.create', ['pelaporan_hasil_audit_id' => $item->id]) }}" class="btn btn-sm btn-info"><i class="mdi mdi-plus"></i> Input Temuan</a>
                                        @if($item->status_approval != 'approved')
                                        <form action="{{ route('audit.pelaporan-hasil-audit.approval', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit" class="btn btn-sm btn-success"><i class="mdi mdi-check"></i> Approve</button>
                                        </form>
                                        @endif
                                        @if($item->status_approval != 'rejected')
                                        <form action="{{ route('audit.pelaporan-hasil-audit.approval', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="mdi mdi-close"></i> Reject</button>
                                        </form>
                                        @endif
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