<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Inventaris;
use App\Models\Proker;
use App\Models\Surats;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function dashboard()
    {
        $totalAnggota = Anggota::count();

        // Surat dibagi berdasarkan type
        $totalSuratMasuk = Surats::where('type', 'Masuk')->count();
        $totalSuratKeluar = Surats::where('type', 'Keluar')->count();
        $totalSurat = Surats::count();

        // Proker dibagi berdasarkan status
        $totalProkerMendatang = Proker::whereDate('tanggal_pelaksanaan', '>=', \Carbon\Carbon::today())->count();
        $totalProkerTerlaksana = Proker::where('status', 'Terlaksana')->count();
        $totalProkerBelumTerlaksana = Proker::where('status', 'belum terlaksana')->count();
        $totalProker = Proker::count();

        // Inventaris total dari kolom jumlah
        $totalInventaris = Inventaris::sum('jumlah');

        return view('pages.dashboard', compact(
            'totalAnggota',
            'totalSuratMasuk',
            'totalSuratKeluar',
            'totalSurat',
            'totalProkerMendatang',
            'totalProkerTerlaksana',
            'totalProkerBelumTerlaksana',
            'totalProker',
            'totalInventaris'
        ));
    }
    public function index()
    {
        $anggota = Anggota::orderBy('id', 'DESC')->get();
        // dd($anggota->all());
        return view('pages.anggota.main', compact('anggota'));
    }
    public function create()
    {
        return view('pages.anggota.tambah');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'nomor_telepon' => 'nullable|string|max:15',
        //     'jabatan' => 'required|string',
        //     'departemen' => 'nullable|string',
        //     'jenis_kelamin' => 'required|string',
        //     'tempat_lahir' => 'required|string|max:255',
        //     'tanggal_lahir' => 'required|date',
        //     'alamat' => 'required|string',
        //     'keahlian' => 'required|string',
        // ]);

        // dd($request->all());
        $nomorTelepon = $request->input('nomor_telepon');
        if ($nomorTelepon && !str_starts_with($nomorTelepon, '0')) {
            $nomorTelepon = '0' . $nomorTelepon;
        }


        $anggota = Anggota::create([
            'nama' => $request->nama ?? '-',
            'nomor_telepon' => $nomorTelepon ?? '-',
            'jabatan' => $request->jabatan ?? '-',
            'departemen' => $request->departemen ?? '-',
            'jenis_kelamin' => $request->jenis_kelamin ?? '-',
            'tempat_lahir' => $request->tempat_lahir ?? '-',
            'tanggal_lahir' => $request->tanggal_lahir ?? '-',
            'alamat' => $request->alamat ?? '-',
            'keahlian' => $request->keahlian ?? '-',
        ]);

        $anggota->save();

        return redirect()->route('anggota');
    }

    // public function update(Request $request, $id)
    // {
    //     dd($request->all()); // This will dump all the incoming request data

    //     try {
    //         // Cari anggota berdasarkan ID
    //         $anggota = Anggota::findOrFail($id);

    //         // Process the data and update the member record...
    //         $nomorTelepon = $request->input('nomor_telepon', '');

    //         if ($nomorTelepon && !str_starts_with($nomorTelepon, '0')) {
    //             $nomorTelepon = '0' . $nomorTelepon;
    //         }

    //         $anggota->update([
    //             'nama' => $request->nama ?? '-',
    //             'nomor_telepon' => $nomorTelepon ?? '-',
    //             'jabatan' => $request->jabatan ?? '-',
    //             'departemen' => $request->departemen ?? '-',
    //             'jenis_kelamin' => $request->jenis_kelamin ?? '-',
    //             'tempat_lahir' => $request->tempat_lahir ?? '-',
    //             'tanggal_lahir' => $request->tanggal_lahir ?? '-',
    //             'alamat' => $request->alamat ?? '-',
    //             'keahlian' => $request->keahlian ?? '-',
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data berhasil diperbarui!'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat memperbarui data.'], 500);
    //     }
    // }

    public function update(Request $request, $id)
    {
        // Debug untuk memastikan data diterima
        if ($request->ajax()) {
            dd('Data diterima:', $request->all());
        }

        $anggota = Anggota::find($id);
        if (!$anggota) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $nomorTelepon = $request->input('nomor_telepon', '');
        if ($nomorTelepon && !str_starts_with($nomorTelepon, '0')) {
            $nomorTelepon = '0' . $nomorTelepon;
        }

        $departemen = null;
        if (in_array($request->jabatan, ['Koordinator', 'Anggota'])) {
            $departemen = $request->departemen ?? '-';
        }

        $anggota->update([
            'nama' => $request->nama ?? '-',
            'nomor_telepon' => $nomorTelepon ?? '-',
            'jabatan' => $request->jabatan ?? '-',
            'departemen' => $departemen,
            'jenis_kelamin' => $request->jenis_kelamin ?? '-',
            'tempat_lahir' => $request->tempat_lahir ?? '-',
            'tanggal_lahir' => $request->tanggal_lahir ?? '-',
            'alamat' => $request->alamat ?? '-',
            'keahlian' => $request->keahlian ?? '-',
        ]);


        return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui','data' => $anggota]);
    }

    public function show($id)
    {
        $anggota = Anggota::find($id);
        // dd($anggota);
        return response()->json($anggota);
    }
}
