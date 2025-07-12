@extends('layouts.vertical', ['title' => 'Entry Meeting'])

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
            <h4 class="page-title">Entry Meeting</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('audit.entry-meeting.create') }}" class="btn btn-primary mb-3">Tambah Entry Meeting</a>
                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Auditee</th>
                                <th>Undangan</th>
                                <th>Absensi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $i => $item)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->auditee ? $item->auditee->direktorat . ' - ' . $item->auditee->divisi_cabang : '-' }}</td>
                                <td><a href="{{ asset('storage/' . $item->file_undangan) }}" target="_blank">Download</a></td>
                                <td><a href="{{ asset('storage/' . $item->file_absensi) }}" target="_blank">Download</a></td>
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
                                    <a href="{{ route('audit.entry-meeting.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('audit.entry-meeting.destroy', $item->id) }}" method="POST" style="display:inline-block" class="delete-form">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete-swal">Hapus</button>
                                    </form>
                                    @if($item->status_approval == 'pending')
                                    <form action="{{ route('audit.entry-meeting.approval', $item->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        <input type="hidden" name="action" id="action-{{ $item->id }}" value="">
                                        <button type="button" class="btn btn-success btn-sm btn-approve-swal" data-id="{{ $item->id }}">Approve</button>
                                        <button type="submit" name="action" value="reject" class="btn btn-secondary btn-sm">Reject</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
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
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete-swal').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = btn.closest('form');
                Swal.fire({
                    title: 'Hapus Entry Meeting?',
                    text: 'Yakin ingin menghapus Entry Meeting ini?',
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
        document.querySelectorAll('.btn-approve-swal').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = btn.closest('form');
                const itemId = btn.dataset.id;
                const hiddenInputAction = document.getElementById(`action-${itemId}`);
                Swal.fire({
                    title: 'Approve Entry Meeting?',
                    text: 'Yakin ingin approve Entry Meeting ini?',
                    icon: 'question',
                    confirmButtonText: 'Ya, Approve',
                    cancelButtonText: 'Batal',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        hiddenInputAction.value = 'approve';
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection 