@extends('main')
@section('title')
    Data Inventaris | IPNU IPPNU
@endsection
@section('main-content')
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Data Inventaris</h1>
        <div class="ml-auto d-flex align-items-center">
            <a href="/tambah-inventaris" class="btn btn-primary mr-2">Tambah Barang</a>

            <a href="{{ route('inventaris.cetak') }}" target="_blank" class="btn btn-success">
                <i class="fas fa-print"></i> Cetak (PDF)
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Data Inventaris</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-1">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">#</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Kondisi</th>
                            <th>Penanggung Jawab</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventaris as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->jumlah }} {{ $item->satuan }}</td>
                                <td>
                                    @php
                                        $badges = [];

                                        if ($item->jumlah_baik) {
                                            $badges[] =
                                                '<span class="badge badge-success">' .
                                                $item->jumlah_baik .
                                                ' Baik</span>';
                                        }
                                        if ($item->jumlah_perbaikan) {
                                            $badges[] =
                                                '<span class="badge badge-warning">' .
                                                $item->jumlah_perbaikan .
                                                ' Perbaikan</span>';
                                        }
                                        if ($item->jumlah_rusak) {
                                            $badges[] =
                                                '<span class="badge badge-danger">' .
                                                $item->jumlah_rusak .
                                                ' Rusak</span>';
                                        }

                                        if ($badges) {
                                            echo implode(' ', $badges);
                                        } else {
                                            // Tampilkan badge tunggal berdasarkan kondisi jika data jumlah tidak tersedia
                                            $badgeClass = match (strtolower($item->kondisi)) {
                                                'baik' => 'success',
                                                'perlu perbaikan' => 'warning',
                                                'rusak' => 'danger',
                                                default => 'secondary',
                                            };
                                            echo '<span class="badge badge-' .
                                                $badgeClass .
                                                '">' .
                                                $item->kondisi .
                                                '</span>';
                                        }
                                    @endphp
                                </td>

                                <td>{{ $item->penanggung_jawab }}</td>
                                <td>
                                    <a href="#" class="btn btn-icon btn-sm btn-warning mb-2"><i
                                            class="far fa-edit"></i></a>
                                    <button class="btn btn-icon btn-sm btn-danger mb-2" data-id="{{ $item->id }}"
                                        data-confirm="Konfirmasi|Ingin menghapus data ini?"
                                        data-confirm-yes="handleHapusInventaris">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="hapusInventaris{{ $item->id }}"
                                        action="{{ route('inventaris.hapus', $item->id) }}" method="POST"
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
        function hapusInvetaris(id) {
            fetch(`/inevntaris/${id}`, {
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
    </script>
@endsection
