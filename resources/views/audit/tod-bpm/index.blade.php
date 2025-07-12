@extends('layouts.vertical', ['title' => 'Hasil TOD BPM Audit'])

@section('css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css',
        'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
        'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'
     ])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Hasil TOD BPM Audit</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('audit.tod-bpm.create') }}" class="btn btn-primary mb-3">Tambah BPM</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-bordered dt-responsive nowrap" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Surat Tugas</th>
                                <th>Judul BPM</th>
                                <th>Nama BPO</th>
                                <th>File BPM</th>
                                <th>Status</th>
                                <th>Evaluasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $i => $item)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $item->perencanaanAudit ? $item->perencanaanAudit->nomor_surat_tugas : '-' }}</td>
                                <td>{{ $item->judul_bpm }}</td>
                                <td>{{ $item->nama_bpo }}</td>
                                <td>
                                    @if($item->file_bpm)
                                        <a href="{{ asset('storage/' . $item->file_bpm) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ asset('storage/' . $item->file_bpm) }}" download class="btn btn-sm btn-primary">Download</a>
                                    @else
                                        -
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
                                    <a href="#" class="btn btn-info btn-sm btn-evaluasi-modal" data-bpm-id="{{ $item->id }}">Evaluasi ({{ $item->evaluasi->count() }})</a>
                                </td>
                                <td>
                                    <a href="{{ route('audit.tod-bpm.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('audit.tod-bpm.destroy', $item->id) }}" method="POST" style="display:inline-block" class="delete-form">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete-swal">Hapus</button>
                                    </form>
                                    @if($item->status_approval == 'pending')
                                    <form action="{{ route('audit.tod-bpm.approval', $item->id) }}" method="POST" style="display:inline-block">
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
<!-- Modal Evaluasi BPM -->
<div class="modal fade" id="evaluasiModal" tabindex="-1" aria-labelledby="evaluasiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="evaluasiModalLabel">Evaluasi BPM</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="evaluasi-modal-content">
          <div class="text-center py-5">Loading...</div>
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
        // Delete confirmation
        document.querySelectorAll('.btn-delete-swal').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = btn.closest('form');

                Swal.fire({
                    title: 'Hapus BPM?',
                    text: 'Yakin ingin menghapus BPM ini?',
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

        // Approve confirmation
        document.querySelectorAll('.btn-approve-swal').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = btn.closest('form');
                const itemId = btn.dataset.id;
                const hiddenInputAction = document.getElementById(`action-${itemId}`);

                Swal.fire({
                    title: 'Approve BPM?',
                    text: 'Yakin ingin approve BPM ini?',
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

function loadEvaluasi(bpmId) {
    const modalContent = document.getElementById('evaluasi-modal-content');
    modalContent.innerHTML = '<div class="text-center py-5">Loading...</div>';
    fetch(`/audit/tod-bpm-evaluasi-modal/${bpmId}`)
        .then(res => res.text())
        .then(html => { modalContent.innerHTML = html; });
}
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-evaluasi-modal').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const bpmId = btn.dataset.bpmId;
            loadEvaluasi(bpmId);
            var modal = new bootstrap.Modal(document.getElementById('evaluasiModal'));
            modal.show();
        });
    });
});
</script>
@endsection 