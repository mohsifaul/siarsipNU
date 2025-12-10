<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Daftar Inventaris</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
            margin: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
        }

        .header h3 {
            margin: 0;
            font-size: 16px;
        }

        .small {
            font-size: 10px;
            color: #666;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 10px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 4px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f7f7f7;
            font-size: 10px;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        ul {
            margin: 0;
            padding-left: 16px;
        }

        li {
            margin: 1px 0;
            font-size: 10px;
        }

        tfoot th {
            background: #e8e8e8;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>Daftar Inventaris</h3>
        <h3>Pimpinan Ranting IPNU IPPNU Desa Blabak</h3>
        <h3>Periode 2023 - 2025</h3>
        <p class="small">Dicetak pada: {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('d F Y H:i') }}</p>
    </div>

    @php
        $totalJumlah = $items->sum('jumlah');
    @endphp

    <table>
        <thead>
            <tr>
                <th style="width:25px;">No</th>
                <th style="width:150px;">Nama</th>
                <th style="width:70px;">Kategori</th>
                <th style="width:50px;" class="center">Jumlah</th>
                <th style="width:120px;">Kondisi</th>
                <th style="width:100px;">Keterangan</th>
                <th style="width:100px;">Penanggung Jawab</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $i => $it)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>{{ $it->nama_barang }}</td>
                    <td>{{ $it->kategori ?? '-' }}</td>
                    <td class="center">{{ number_format($it->jumlah ?? 0) }}</td>
                    <td>
                        @php
                            $kondisiList = [];

                            if ($it->jumlah_baik) {
                                $kondisiList[] = $it->jumlah_baik . ' Baik';
                            }
                            if ($it->jumlah_perbaikan) {
                                $kondisiList[] = $it->jumlah_perbaikan . ' Perlu Perbaikan';
                            }
                            if ($it->jumlah_rusak) {
                                $kondisiList[] = $it->jumlah_rusak . ' Rusak';
                            }
                        @endphp

                        @if(count($kondisiList) > 0)
                            <ul>
                                @foreach($kondisiList as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ $it->kondisi ?? '-' }}
                        @endif
                    </td>
                    <td>{{ $it->keterangan ?? '-' }}</td>
                    <td>{{ $it->penanggung_jawab ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="center small">Tidak ada data inventaris</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7" class="center">Total Jumlah: {{ number_format($totalJumlah) }}</th>
            </tr>
        </tfoot>
    </table>
</body>

</html>