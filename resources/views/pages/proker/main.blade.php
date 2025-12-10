@extends('main')
@section('title')
    Data Program Kerja | IPNU IPPNU
@endsection
@section('main-content')
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Data Program Kerja</h1>
        <!-- Tombol untuk menampilkan modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahProker">
            Tambah Proker
        </button>

    </div>

    @include('pages.proker.component.cardProker')

    <div class="card">
        <div class="card-header">
            <h4>Data Program Kerja</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-1">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">#</th>
                            <th>Nama Proker</th>
                            <th>Tanggal</th>
                            <th>Penanggun Jawab</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proker as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_program }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->locale('id')->translatedFormat('l, d F Y') }}
                                </td>
                                @if ($item->divisi == 'Pengurus Harian')
                                    <td>{{ $item->divisi }}</td>
                                @else
                                    <td>Departemen {{ $item->divisi }}</td>
                                @endif
                                <td>
                                    @if ($item->status == 'Mendatang')
                                        <span class="badge badge-warning">Mendatang</span>
                                    @elseif($item->status == 'Terlaksana')
                                        <span class="badge badge-success">{{ $item->status }}</span>
                                    @elseif($item->status = 'Belum Terlaksana')
                                        <span class="badge badge-danger">Tidak Terlaksana</span>
                                    @else
                                        <span class="badge badge-secondary">Terlewat</span>
                                        <!-- Untuk status lain -->
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                            data-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($item->status != 'Terlaksana')
                                                <a class="dropdown-item text-warning btn-edit" type="button"
                                                    data-id="{{ $item->id }}" href="#" data-toggle="modal"
                                                    data-target="#editProker"><i class="fas fa-edit"></i>
                                                    Edit</a>
                                                <a class="dropdown-item text-dark btn-file" type="button"
                                                    data-id="{{ $item->id }}" href="#" data-toggle="modal"
                                                    data-target="#fileProker"><i class="fas fa-file"></i>
                                                    Lihat
                                                    File</a>
                                            @endif
                                            <a class="dropdown-item text-info" href="#"><i
                                                    class="fas fa-info-circle"></i>
                                                Detail</a>
                                            <a href="#" class="dropdown-item text-danger"
                                                data-id="{{ $item->id }}"
                                                data-confirm="Konfirmasi|Ingin menghapus proker ini?"
                                                data-confirm-yes="handleHapusProker">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                            <form id="hapusForm{{ $item->id }}"
                                                action="{{ route('proker.hapus', $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function hapusProker(id) {
            fetch(`/proker/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    location.reload();
                })
                .catch(err => {
                    console.error('Gagal mengubah status:', err);
                });
        }

        // Event listener untuk tombol edit
        // Script untuk fetch data dan menampilkan di modal
        document.querySelectorAll('.btn-edit').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');

                // Gantikan URL dengan route Laravel untuk mengambil data berdasarkan ID
                fetch(`{{ route('proker.edit', ':id') }}`.replace(':id', id))
                    .then(response => response.json())
                    .then(data => {
                        // Isi modal dengan data yang didapat
                        document.querySelector('#editProker input[name="id"]').value = data.id;
                        document.querySelector('#editProker input[name="nama_program"]').value = data
                            .nama_program;
                        document.querySelector('#editProker textarea[name="deskripsi"]').value = data
                            .deskripsi;
                        document.querySelector('#editProker input[name="tanggal_pelaksanaan"]').value =
                            data.tanggal_pelaksanaan;
                        document.querySelector('#editProker input[name="tempat"]').value = data.tempat;
                        document.querySelector('#editProker input[name="penanggung_jawab"]').value =
                            data.penanggung_jawab;
                        document.querySelector('#editProker select[name="divisi"]').value = data.divisi;
                        document.querySelector('#editProker input[name="anggaran"]').value = data
                            .anggaran;
                        document.querySelector('#editProker select[name="status"]').value = data.status;

                        // Jika statusnya "Terlaksana" (atau "Selesai"), disable dropdown status
                        if (data.status === 'Terlaksana') {
                            document.querySelector('#editProker select[name="status"]').disabled = true;
                        } else {
                            document.querySelector('#editProker select[name="status"]').disabled =
                                false;
                        }

                        // Tampilkan modal edit
                        $('#editProker').modal('show');
                    })
                    .catch(error => {
                        console.error('Gagal fetch data:', error);
                    });
            });
        });

        // Reset form ketika modal ditutup
        $('#editProker').on('hidden.bs.modal', function() {
            // Reset semua input di dalam form modal
            document.querySelector('#prokerForm').reset();

            // Reset status dropdown dan disabled property
            document.querySelector('#editProker select[name="divisi"]').value = '';
            document.querySelector('#editProker select[name="status"]').value = '';
            document.querySelector('#editProker select[name="status"]').disabled = false; // Enable status kembali
        });
    </script>
@endsection
@include('pages.proker.component.edit')
@include('pages.proker.component.tambah')
@include('pages.proker.component.file')
