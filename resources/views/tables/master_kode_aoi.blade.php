@extends('layouts.vertical', ['title' => 'Master Kode AOI'])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Master Kode AOI</li>
                </ol>
            </div>
            <h4 class="page-title">Master Kode AOI</h4>
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
                                <th>Indikator Pengawasan</th>
                                <th>Kode Area of Improvement</th>
                                <th>Deskripsi Area of Improvement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->indikator_pengawasan ?: '-' }}</td>
                                    <td>{{ $item->kode_area_of_improvement ?: '-' }}</td>
                                    <td>{{ $item->deskripsi_area_of_improvement ?: '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
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