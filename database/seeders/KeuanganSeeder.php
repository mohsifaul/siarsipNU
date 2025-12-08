<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Keuangan;
use Carbon\Carbon;

class KeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaksi = [
            // Saldo awal (opsional, bisa diwakili dengan pemasukan awal)
            ['tanggal' => '2025-12-01', 'keterangan' => 'Saldo Awal Bulan Desember', 'jenis' => 'pemasukan', 'jumlah' => 1_500_000],

            // Pemasukan
            ['tanggal' => '2025-12-02', 'keterangan' => 'Iuran Anggota (30 orang @Rp50.000)', 'jenis' => 'pemasukan', 'jumlah' => 1_500_000],
            ['tanggal' => '2025-12-05', 'keterangan' => 'Donasi Alumni', 'jenis' => 'pemasukan', 'jumlah' => 2_000_000],
            ['tanggal' => '2025-12-10', 'keterangan' => 'Pendapatan Seminar Kaderisasi', 'jenis' => 'pemasukan', 'jumlah' => 4_500_000],
            ['tanggal' => '2025-12-15', 'keterangan' => 'Bantuan dari PAC', 'jenis' => 'pemasukan', 'jumlah' => 1_000_000],

            // Pengeluaran
            ['tanggal' => '2025-12-03', 'keterangan' => 'Sewa Aula Kegiatan', 'jenis' => 'pengeluaran', 'jumlah' => 1_200_000],
            ['tanggal' => '2025-12-06', 'keterangan' => 'Konsumsi Rapat Rutin', 'jenis' => 'pengeluaran', 'jumlah' => 350_000],
            ['tanggal' => '2025-12-08', 'keterangan' => 'Pengadaan ATK & Dokumentasi', 'jenis' => 'pengeluaran', 'jumlah' => 450_000],
            ['tanggal' => '2025-12-12', 'keterangan' => 'Cetak Buku Panduan Kader', 'jenis' => 'pengeluaran', 'jumlah' => 2_000_000],
            ['tanggal' => '2025-12-18', 'keterangan' => 'Transportasi Studi Banding', 'jenis' => 'pengeluaran', 'jumlah' => 1_800_000],
        ];

        foreach ($transaksi as $data) {
            Keuangan::create([
                'tanggal' => Carbon::parse($data['tanggal']),
                'keterangan' => $data['keterangan'],
                'jenis' => $data['jenis'],
                'jumlah' => $data['jumlah'],
            ]);
        }
    }
}