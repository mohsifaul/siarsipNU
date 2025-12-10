@extends('main')
@section('title')
    Data Anggota | IPNU IPPNU
@endsection
@section('main-content')
    @include('sweetalert::alert')
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Data Anggota</h1>
        <a href="/tambah-anggota" class="btn btn-primary">Tambah</a>
    </div>

    <div class="section-body">
        {{-- Tabel Anggota IPNU (Laki-laki) --}}
        <div class="card">
            <div class="card-header">
                <h4>Data Anggota IPNU</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="table-1">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">#</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>Jabatan</th>
                                <th width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $counter = 1; @endphp {{-- Reset counter to 1 --}}
                            @foreach ($anggota as $item)
                                @if ($item->jenis_kelamin == 'Laki-laki')
                                    <tr class="text-center">
                                        <td>{{ $counter++ }}</td> {{-- Increment counter --}}
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        @if ($item->jabatan == 'Anggota' || $item->jabatan == 'Koordinator')
                                            <td>{{ $item->jabatan }} - {{ $item->departemen }} </td>
                                        @else
                                            <td>{{ $item->jabatan }}</td>
                                        @endif
                                        <td>
                                            {{-- <a href="#" class="btn btn-icon btn-sm btn-primary"><i
                                                    class="far fa-edit"></i> Edit</a> --}}
                                            <button type="button" class="btn btn-icon btn-md btn-primary edit-btn"
                                                data-toggle="modal" data-target="#editModal" data-id="{{ $item->id }}"
                                                data-nama="{{ $item->nama }}" data-telepon="{{ $item->nomor_telepon }}"
                                                data-jabatan="{{ $item->jabatan }}"
                                                data-jenis_kelamin="{{ $item->jenis_kelamin }}"
                                                data-tempat_lahir="{{ $item->tempat_lahir }}"
                                                data-tanggal_lahir="{{ $item->tanggal_lahir }}"
                                                data-alamat="{{ $item->alamat }}" data-keahlian="{{ $item->keahlian }}"
                                                data-departemen="{{ $item->departemen }}">
                                                <i class="far fa-edit"></i> </button>
                                            {{-- <a href="#" class="btn btn-icon btn-md btn-info"><i
                                                    class="fas fa-info-circle"></i></a> --}}
                                            <button type="button" class="btn btn-icon btn-md btn-info info-btn"
                                                data-toggle="modal" data-target="#infoModal" data-id="{{ $item->id }}">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                            <a href="#" class="btn btn-icon btn-md btn-danger"><i
                                                    class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Tabel Anggota IPPNU (Perempuan) --}}
        <div class="card">
            <div class="card-header">
                <h4>Data Anggota IPPNU</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="table-2">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">#</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>Jabatan</th>
                                <th width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $counter = 1; @endphp {{-- Reset counter to 1 --}}
                            @foreach ($anggota as $item)
                                @if ($item->jenis_kelamin == 'Perempuan')
                                    <tr class="text-center" id="anggota-row-{{ $item->id }}">
                                        <td>{{ $counter++ }}</td> {{-- Increment counter --}}
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        @if ($item->jabatan == 'Anggota' || $item->jabatan == 'Koordinator')
                                            <td>{{ $item->jabatan }} - {{ $item->departemen }} </td>
                                        @else
                                            <td>{{ $item->jabatan }}</td>
                                        @endif
                                        <td>
                                            <button type="button" class="btn btn-icon btn-md btn-primary edit-btn"
                                                data-toggle="modal" data-target="#editModal" data-id="{{ $item->id }}"
                                                data-nama="{{ $item->nama }}" data-telepon="{{ $item->nomor_telepon }}"
                                                data-jabatan="{{ $item->jabatan }}"
                                                data-jenis_kelamin="{{ $item->jenis_kelamin }}"
                                                data-tempat_lahir="{{ $item->tempat_lahir }}"
                                                data-tanggal_lahir="{{ $item->tanggal_lahir }}"
                                                data-alamat="{{ $item->alamat }}" data-keahlian="{{ $item->keahlian }}"
                                                data-departemen="{{ $item->departemen }}">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            {{-- <a href="#" class="btn btn-icon btn-md btn-info"><i
                                                    class="fas fa-info-circle"></i></a> --}}
                                            <button type="button" class="btn btn-icon btn-md btn-info info-btn"
                                                data-toggle="modal" data-target="#infoModal" data-id="{{ $item->id }}">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                            <a href="#" class="btn btn-icon btn-md btn-danger"><i
                                                    class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
@endsection
@include('pages/anggota/edit')
@include('pages/anggota/info')
