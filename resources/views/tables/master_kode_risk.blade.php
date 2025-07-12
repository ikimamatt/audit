@extends('layouts.vertical', ['title' => 'Master Kode Risk'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Master Kode Risk</li>
                </ol>
            </div>
            <h4 class="page-title">Master Kode Risk</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered w-100 dt-responsive nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kelompok Risiko</th>
                                <th>Kode Risiko</th>
                                <th>Kelompok Risiko Detail</th>
                                <th>Deskripsi Risiko</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->kelompok_risiko ?: '-' }}</td>
                                    <td>{{ $item->kode_risiko ?: '-' }}</td>
                                    <td>{{ $item->kelompok_risiko_detail ?: '-' }}</td>
                                    <td>{{ $item->deskripsi_risiko ?: '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
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