@extends('layouts.vertical', ['title' => 'Perencanaan Audit'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('audit.perencanaan.index') }}">Audit</a></li>
                    <li class="breadcrumb-item active">Perencanaan Audit</li>
                </ol>
            </div>
            <h4 class="page-title">Perencanaan Audit</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-5">
                        <a href="{{ route('audit.perencanaan.create') }}" class="btn btn-primary mb-2">
                            <i class="mdi mdi-plus-circle me-2"></i> Tambah Perencanaan Audit
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-centered w-100 dt-responsive nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat Tugas</th>
                                <th>Tanggal Surat Tugas</th>
                                <th>Jenis Audit</th>
                                <th>Auditee</th>
                                <th>Nama Auditor</th>
                                <th>Ruang Lingkup</th>
                                <th>Periode Audit</th>
                                <th>Tanggal Audit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nomor_surat_tugas }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_surat_tugas)->format('d/m/Y') }}</td>
                                    <td>{{ $item->jenis_audit }}</td>
                                    <td>{{ $item->auditee->direktorat ?? '-' }} - {{ $item->auditee->divisi_cabang ?? '-' }}</td>
                                    <td>
                                        @if(is_array($item->auditor))
                                            @foreach($item->auditor as $auditor)
                                                <div class="badge bg-primary mb-1">{{ $auditor }}</div>
                                            @endforeach
                                        @else
                                            <span class="badge bg-primary">{{ $item->auditor ?? '-' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(is_array($item->ruang_lingkup))
                                            @foreach($item->ruang_lingkup as $scope)
                                                <div>{{ $scope }}</div>
                                            @endforeach
                                        @else
                                            {{ $item->ruang_lingkup ?? '-' }}
                                        @endif
                                    </td>
                                    <td>{{ $item->periode_audit }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_audit_mulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($item->tanggal_audit_sampai)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('audit.perencanaan.edit', $item->id) }}" class="btn btn-sm btn-info">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('audit.perencanaan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Tidak ada data</td>
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
