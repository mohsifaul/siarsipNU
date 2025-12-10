@extends('main')
@section('title')
    Dashboard | IPNU IPPNU
@endsection
@section('main-content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Data Anggota</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalAnggota ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Surat Masuk</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalSuratMasuk ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Surat Keluar</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalSuratKeluar ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-list"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Program Kerja</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalProker ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Inventaris</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalInventaris ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Breakdown -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-envelope mr-2"></i>Status Surat</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card card-danger">
                                <div class="card-body text-center py-3">
                                    <h6 class="text-muted mb-2">Surat Masuk</h6>
                                    <h3 class="mb-0">{{ $totalSuratMasuk ?? 0 }}</h3>
                                    <small class="text-muted">dari {{ $totalSurat ?? 0 }} total</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card card-warning">
                                <div class="card-body text-center py-3">
                                    <h6 class="text-muted mb-2">Surat Keluar</h6>
                                    <h3 class="mb-0">{{ $totalSuratKeluar ?? 0 }}</h3>
                                    <small class="text-muted">dari {{ $totalSurat ?? 0 }} total</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress" style="height: 25px;">
                        @php
                            $persenMasuk = $totalSurat > 0 ? ($totalSuratMasuk / $totalSurat) * 100 : 0;
                            $persenKeluar = $totalSurat > 0 ? ($totalSuratKeluar / $totalSurat) * 100 : 0;
                        @endphp
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $persenMasuk }}%;"
                            aria-valuenow="{{ $persenMasuk }}" aria-valuemin="0" aria-valuemax="100">
                            Masuk {{ round($persenMasuk) }}%
                        </div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $persenKeluar }}%;"
                            aria-valuenow="{{ $persenKeluar }}" aria-valuemin="0" aria-valuemax="100">
                            Keluar {{ round($persenKeluar) }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-tasks mr-2"></i>Status Program Kerja</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="card card-info">
                                <div class="card-body text-center py-3">
                                    <h6 class="text-muted mb-2">Mendatang</h6>
                                    <h3 class="mb-0">{{ $totalProkerMendatang ?? 0 }}</h3>
                                    <small class="text-muted">dari {{ $totalProker ?? 0 }} total</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card card-success">
                                <div class="card-body text-center py-3">
                                    <h6 class="text-muted mb-2">Terlaksana</h6>
                                    <h3 class="mb-0">{{ $totalProkerTerlaksana ?? 0 }}</h3>
                                    <small class="text-muted">dari {{ $totalProker ?? 0 }} total</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="card card-danger">
                                <div class="card-body text-center py-3">
                                    <h6 class="text-muted mb-2">Belum Terlaksana</h6>
                                    <h3 class="mb-0">{{ $totalProkerBelumTerlaksana ?? 0 }}</h3>
                                    <small class="text-muted">dari {{ $totalProker ?? 0 }} total</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
