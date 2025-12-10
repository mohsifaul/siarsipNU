<?php

namespace Database\Seeders;

use App\Models\Surats;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Surat Masuk
            [
                'id' => Str::uuid(),
                'nomor_surat' => 'SM/001/IPNU/2025',
                'perihal' => 'Undangan Rapat Koordinasi',
                'pengirim' => 'Ketua IPNU Pusat',
                'tanggal_surat' => Carbon::now()->subDays(5),
                'type' => 'Masuk',
                'lampiran' => 'upload/surat/lampiran1.pdf',
                'status' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nomor_surat' => 'SM/002/IPNU/2025',
                'perihal' => 'Laporan Kegiatan Bulanan',
                'pengirim' => 'Cabang IPNU Jawa Tengah',
                'tanggal_surat' => Carbon::now()->subDays(3),
                'type' => 'Masuk',
                'lampiran' => 'upload/surat/lampiran2.pdf',
                'status' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nomor_surat' => 'SM/003/IPNU/2025',
                'perihal' => 'Permohonan Dukungan Dana',
                'pengirim' => 'Pengurus Ranting',
                'tanggal_surat' => Carbon::now(),
                'type' => 'Masuk',
                'lampiran' => 'upload/surat/lampiran3.pdf',
                'status' => 'Diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nomor_surat' => 'SM/004/IPNU/2025',
                'perihal' => 'Undangan Pelatihan Kepemimpinan',
                'pengirim' => 'PC IPNU Surabaya',
                'tanggal_surat' => Carbon::now()->addDays(2),
                'type' => 'Masuk',
                'lampiran' => 'upload/surat/lampiran4.pdf',
                'status' => 'Belum Diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nomor_surat' => 'SM/005/IPNU/2025',
                'perihal' => 'Jadwal Rapat Dewan Pengurus',
                'pengirim' => 'Sekretaris IPNU',
                'tanggal_surat' => Carbon::now()->addDays(5),
                'type' => 'Masuk',
                'lampiran' => 'upload/surat/lampiran5.pdf',
                'status' => 'Belum Diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Surat Keluar
            [
                'id' => Str::uuid(),
                'nomor_surat' => 'SK/001/IPNU/2025',
                'perihal' => 'Persetujuan Kegiatan Rutin',
                'pengirim' => 'Ketua IPNU Blabak',
                'tanggal_surat' => Carbon::now()->subDays(10),
                'type' => 'Keluar',
                'lampiran' => 'upload/surat/lampiran6.pdf',
                'status' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nomor_surat' => 'SK/002/IPNU/2025',
                'perihal' => 'Izin Pelaksanaan Kegiatan',
                'pengirim' => 'Ketua IPNU Blabak',
                'tanggal_surat' => Carbon::now()->subDays(7),
                'type' => 'Keluar',
                'lampiran' => 'upload/surat/lampiran7.pdf',
                'status' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nomor_surat' => 'SK/003/IPNU/2025',
                'perihal' => 'Balasan Permohonan Dukungan',
                'pengirim' => 'Ketua IPNU Blabak',
                'tanggal_surat' => Carbon::now()->subDays(2),
                'type' => 'Keluar',
                'lampiran' => 'upload/surat/lampiran8.pdf',
                'status' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nomor_surat' => 'SK/004/IPNU/2025',
                'perihal' => 'Undangan Acara Silaturahmi',
                'pengirim' => 'Ketua IPNU Blabak',
                'tanggal_surat' => Carbon::now()->addDays(3),
                'type' => 'Keluar',
                'lampiran' => 'upload/surat/lampiran9.pdf',
                'status' => 'Diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nomor_surat' => 'SK/005/IPNU/2025',
                'perihal' => 'Pengumuman Rekrutmen Anggota Baru',
                'pengirim' => 'Ketua IPNU Blabak',
                'tanggal_surat' => Carbon::now()->addDays(7),
                'type' => 'Keluar',
                'lampiran' => 'upload/surat/lampiran10.pdf',
                'status' => 'Belum Diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Surats::insert($data);
    }
}