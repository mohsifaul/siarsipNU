@extends('main')
@section('title')
    Surat Masuk | IPNU IPPNU
@endsection
@section('main-content')
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Data Surat Masuk</h1>
        <a href="{{ route('surat.masuk.tambah') }}" class="btn btn-primary">Tambah</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Data Surat Masuk</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-1">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">#</th>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            <th>Pengirim</th>
                            <th width="10%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use Carbon\Carbon;
                            Carbon::setLocale('id');
                        @endphp
                        @foreach ($surats as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nomor_surat }}</td>
                                <td>
                                    {{ $item->perihal }} <br>
                                    <b>Tanggal:</b> {{ Carbon::parse($item->tanggal_surat)->translatedFormat('l, d F Y') }}
                                </td>
                                <td>{{ $item->pengirim }}</td>
                                @php
                                    $tanggalSurat = Carbon::parse($item->tanggal_surat);
                                    $today = Carbon::today();
                                    $isOverdue = $tanggalSurat->lt($today);
                                    $isFuture = $tanggalSurat->gt($today);

                                    if ($item->status == 'Selesai') {
                                        $status = 'Selesai';
                                    } elseif ($isFuture) {
                                        $status = 'Mendatang';
                                    } elseif ($isOverdue) {
                                        $status = 'Selesai';
                                    } else {
                                        $status = $item->status;
                                    }
                                @endphp
                                @if ($status == 'Selesai')
                                    <td><span class="badge badge-success">{{ $status }}</span></td>
                                @elseif ($status == 'Mendatang')
                                    <td><span class="badge badge-info">{{ $status }}</span></td>
                                @else
                                    <td><span class="badge badge-light">{{ $status }}</span></td>
                                @endif
                                <td>
                                    @if ($status != 'Selesai')
                                        {{-- <a href="#" class="btn btn-icon btn-sm btn-warning mb-2"><i
                                                class="far fa-edit"></i></a> --}}
                                        <button class="btn btn-icon btn-sm btn-success mb-2"
                                            data-confirm="Konfirmasi|Ingin menyelesaikan surat ini?"
                                            data-confirm-yes="updateStatus('{{ $item->id }}')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @endif
                                    <button class="btn btn-icon btn-sm btn-primary mb-2" id="modal-1"
                                        data-lampiran="{{ asset($item->lampiran) }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="#" class="btn btn-icon btn-sm btn-danger mb-2" data-id="{{ $item->id }}"
                                        data-confirm="Konfirmasi|Ingin menghapus surat ini?"
                                        data-confirm-yes="handleHapusSurats">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="hapusForm{{ $item->id }}"
                                        action="{{ route('surat.destroy', $item->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let isModalOpen = false;

        function openModal(lampiran) {
            if (isModalOpen) {
                return; // Prevent opening another modal if one is already open
            }

            isModalOpen = true; // Set the flag to true

            // Create and open the modal
            $("#modal-1").fireModal({
                title: 'Lampiran',
                body: `<div class="text-center"><img src="${lampiran}" class="img-fluid" alt="Lampiran"></div>`,
                onClose: function() {
                    isModalOpen = false; // Reset the flag when the modal is closed
                }
            });
        }

        document.querySelectorAll('[id^="modal-1"]').forEach(button => {
            button.addEventListener('click', function() {
                const lampiran = $(this).data('lampiran');
                console.log("Data: " + lampiran);
                openModal(lampiran);
            });
        });

        function updateStatus(id) {
            fetch(`/surat-masuk/update-status/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    $('#confirmModal').modal('hide');

                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to update status!');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
