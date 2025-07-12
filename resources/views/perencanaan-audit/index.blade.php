@extends('layouts.vertical', ['title' => 'Program Kerja Audit'])

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
            <h4 class="page-title">Program Kerja Audit</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('audit.pka.create') }}" class="btn btn-primary mb-3">Tambah PKA</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-bordered dt-responsive nowrap" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Surat Tugas</th>
                                <th>No PKA</th>
                                <th>Tanggal PKA</th>
                                <th>Milestone</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $i => $item)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $item->perencanaanAudit->nomor_surat_tugas ?? '-' }}</td>
                                <td>{{ $item->no_pka }}</td>
                                <td>{{ $item->tanggal_pka }}</td>
                                <td>
                                    <ul class="mb-0 ps-3">
                                    @foreach($item->milestones as $m)
                                        <li>{{ $m->nama_milestone }}: {{ $m->tanggal_mulai }} - {{ $m->tanggal_selesai }}</li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('audit.pka.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('audit.pka.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('audit.pka.destroy', $item->id) }}" method="POST" style="display:inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
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
</div>
@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection 