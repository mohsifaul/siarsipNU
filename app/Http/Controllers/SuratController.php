<?php

namespace App\Http\Controllers;

use App\Models\Surats;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $routeName = $request->route()->getName();

        if ($routeName === 'surat.masuk') {
            $surats = DB::table('surats')->where('type', 'masuk')->get();
            // $surats = Surats::where('type', 'masuk')->get();
            return view('pages.surat.masuk.main', compact('surats'));
        } elseif ($routeName === 'surat.keluar') {
            $surats = Surats::where('type', 'keluar')->get();
            return view('pages.surat.keluar.main', compact('surats'));
        } else {
            abort(404);
        }
    }


    public function create(Request $request)
    {
        $routeName = $request->route()->getName();


        if ($routeName === 'surat.masuk.tambah') {
            return view('pages.surat.masuk.tambah'); // Mengarahkan ke halaman tambah surat masuk
        } elseif ($routeName === 'surat.keluar.tambah') {
            return view('pages.surat.keluar.tambah'); // Mengarahkan ke halaman tambah surat keluar
        } else {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');

            // Replace slashes with underscores or dashes
            $safeFileName = str_replace('/', '_', $request->nomor_surat);
            $fileName = $safeFileName . '.' . $file->getClientOriginalExtension(); // Nama file berdasarkan nomor surat

            $file->move(public_path('upload/file-surat'), $fileName); // Pindahkan file ke folder
            $lampiranPath = 'upload/file-surat/' . $fileName; // Simpan path file
        }

        $surats = Surats::create([
            'nomor_surat' => $request->nomor_surat ?? '-',
            'tanggal_surat' => $request->tanggal_surat ?? '-',
            'pengirim' => $request->pengirim ?? '-',
            'perihal' => $request->perihal ?? '-',
            'lampiran' => $lampiranPath ?? '-',
            'type' => $request->type ?? '-',
            'status' => 'Diproses',
        ]);
        $surats->save();

        if ($request->type == 'masuk') {
            return redirect()->route('surat.masuk');
        } else {
            return redirect()->route('surat.keluar');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $surat = Surats::find($id);

        if ($surat) {
            $surat->status = 'Selesai';
            $surat->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Surat not found!'], 404);
    }


    // public function edit(SuratMasuk $suratMasuk)
    // {
    //     return view('suratMasuk.edit', compact('suratMasuk'));
    // }

    // public function update(Request $request, SuratMasuk $suratMasuk)
    // {
    //     $request->validate([
    //         'nomor_surat' => 'required|unique:surat_masuks,nomor_surat,' . $suratMasuk->id,
    //         'tanggal_surat' => 'required|date',
    //         'pengirim' => 'required|string|max:255',
    //         'perihal' => 'required|string|max:255',
    //         'isi_surat' => 'required',
    //         'lampiran' => 'nullable|string|max:255',
    //     ]);

    //     $suratMasuk->update($request->all());

    //     return redirect()->route('suratMasuk.index')->with('success', 'Surat masuk berhasil diperbarui.');
    // }

    // public function destroy(SuratMasuk $suratMasuk)
    // {
    //     $suratMasuk->delete();

    //     return redirect()->route('suratMasuk.index')->with('success', 'Surat masuk berhasil dihapus.');
    // }

    public function destroy($id)
    {
        $surat = Surats::find($id);

        if (!$surat) {
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Simpan tipe sebelum dihapus untuk redirect
        $type = strtolower($surat->type ?? '');

        // Hapus file lampiran jika ada
        if (!empty($surat->lampiran) && file_exists(public_path($surat->lampiran))) {
            @unlink(public_path($surat->lampiran));
        }

        $surat->delete();

        // Tampilkan toast dan redirect sesuai tipe surat
        toast('Data berhasil dihapus', 'success');

        if ($type === 'keluar') {
            return redirect()->route('surat.keluar');
        }

        return redirect()->route('surat.masuk');
    }
}
