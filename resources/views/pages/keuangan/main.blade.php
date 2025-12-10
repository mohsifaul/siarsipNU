@extends('main')
@section('title')
    Buku Kas | Keuangan IPNU IPPNU
@endsection

@section('main-content')
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Buku Kas Organisasi</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahTransaksi">
            <i class="fas fa-plus mr-1"></i> Tambah Transaksi
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0">Rincian Transaksi Keuangan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-1">
                    <thead class="text-center bg-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                            <th>Saldo</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $saldo = 0;
                        @endphp

                        @forelse ($transaksi as $index => $item)
                            @php
                                $saldo += $item->jenis === 'pemasukan' ? $item->jumlah : -$item->jumlah;
                            @endphp
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="text-center align-middle">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('d M Y') }}
                                </td>
                                <td class="align-middle">{{ $item->keterangan }}</td>
                                <td class="text-right align-middle">
                                    @if ($item->jenis === 'pemasukan')
                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                                <td class="text-right align-middle">
                                    @if ($item->jenis === 'pengeluaran')
                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                                <td class="text-right align-middle font-weight-bold">
                                    Rp {{ number_format($saldo, 0, ',', '.') }}
                                </td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-icon btn-md btn-primary edit-btn" data-id="{{ $item->id }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="#" class="btn btn-icon btn-md btn-danger ml-1" data-id="{{ $item->id }}" title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>

                    @if ($transaksi->count() > 0)
                        <tfoot class="font-weight-bold bg-light">
                            <tr>
                                <td colspan="3" class="text-right">TOTAL</td>
                                <td class="text-right">
                                    Rp {{ number_format($transaksi->where('jenis', 'pemasukan')->sum('jumlah'), 0, ',', '.') }}
                                </td>
                                <td class="text-right">
                                    Rp {{ number_format($transaksi->where('jenis', 'pengeluaran')->sum('jumlah'), 0, ',', '.') }}
                                </td>
                                <td class="text-right">
                                    Rp {{ number_format($saldo, 0, ',', '.') }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection

<!-- Modal Tambah Transaksi -->
<div class="modal fade" id="tambahTransaksi" tabindex="-1" aria-labelledby="tambahTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahTransaksiLabel">Tambah Transaksi Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal *</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required
                            value="{{ now()->format('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan *</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="Contoh: Iuran anggota, Sewa aula" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis Transaksi *</label>
                        <select class="form-control" id="jenis" name="jenis" required>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah (Rp) *</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="1"
                            placeholder="Masukkan nominal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>