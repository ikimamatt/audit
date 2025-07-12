@extends('layouts.vertical', ['title' => 'ISI LHA/LHK'])

@section('css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
     ])
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title mb-0">Daftar ISI LHA/LHK</h4>
            </div>
            <div class="card-body">
                <a href="{{ route('audit.isi-lha.create') }}" class="btn btn-primary mb-3">Tambah ISI LHA/LHK</a>
                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-hover dt-responsive nowrap">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Judul LHA/LHK</th>
                                <th width="15%">Nomor ISS</th>
                                <th width="20%">Permasalahan</th>
                                <th width="10%">Signifikansi</th>
                                <th width="10%">Status</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->pelaporanHasilAudit->nomor_lha_lhk ?? '-' }}</td>
                                <td>{{ $item->nomor_iss }}</td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;" title="{{ $item->permasalahan }}">
                                        {{ Str::limit($item->permasalahan, 100) }}
                                    </div>
                                </td>
                                <td>
                                    @if($item->signifikansi == 'Tinggi')
                                        <span class="badge bg-danger">{{ $item->signifikansi }}</span>
                                    @elseif($item->signifikansi == 'Medium')
                                        <span class="badge bg-warning">{{ $item->signifikansi }}</span>
                                    @elseif($item->signifikansi == 'Rendah')
                                        <span class="badge bg-success">{{ $item->signifikansi }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $item->signifikansi ?? '-' }}</span>
                                    @endif
                                </td>
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
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('audit.isi-lha.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                                        <a href="{{ route('audit.isi-lha.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteItem({{ $item->id }})">Hapus</button>
                                        @if($item->status_approval != 'approved')
                                        <button type="button" class="btn btn-sm btn-success" onclick="approveItem({{ $item->id }})">Approve</button>
                                        @endif
                                        @if($item->status_approval != 'rejected')
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="rejectItem({{ $item->id }})">Reject</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data ISI LHA/LHK</td>
                            </tr>
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
<script>
function deleteItem(id) {
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
            // Create a form to submit the delete request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/audit/isi-lha/${id}`;
            form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    });
}

function approveItem(id) {
    Swal.fire({
        title: 'Approve ISI LHA/LHK?',
        text: "Apakah Anda yakin ingin approve data ini?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Approve!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create a form to submit the approve request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/audit/isi-lha/${id}/approval`;
            form.innerHTML = `
                @csrf
                <input type="hidden" name="action" value="approve">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    });
}

function rejectItem(id) {
    Swal.fire({
        title: 'Reject ISI LHA/LHK?',
        text: "Apakah Anda yakin ingin reject data ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Reject!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create a form to submit the reject request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/audit/isi-lha/${id}/approval`;
            form.innerHTML = `
                @csrf
                <input type="hidden" name="action" value="reject">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endsection 