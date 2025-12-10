<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Proker;
use Illuminate\Http\Request;

class ProkerController extends Controller
{
    public function index()
    {
        // Ambil semua data proker yang ada, urut berdasarkan tanggal pelaksanaan (terdekat dulu)
        $proker = Proker::orderBy('tanggal_pelaksanaan', 'asc')->get();

        // Ambil bulan saat ini
        $currentMonth = Carbon::now()->format('m');

        // Ambil program yang pelaksanaannya di hari ini atau mendatang, urut berdasarkan tanggal pelaksanaan
        $prokersMendatang = Proker::whereDate('tanggal_pelaksanaan', '>=', Carbon::today())
            ->orderBy('tanggal_pelaksanaan', 'asc')
            ->get();

        // Ambil program yang sudah selesai, urutkan terbaru terlebih dahulu
        $prokersSelesai = Proker::where('status', 'Terlaksana')
            ->orderByDesc('tanggal_pelaksanaan')
            ->get();

        // Ambil program yang belum terlaksana, urut berdasarkan tanggal pelaksanaan terdekat
        $prokersBelumTerlaksana = Proker::where('status', 'belum terlaksana')
            ->orderBy('tanggal_pelaksanaan', 'asc')
            ->get();

        // Mengembalikan ke view dengan data yang diperlukan
        return view('pages.proker.main', compact('proker', 'prokersMendatang', 'prokersSelesai', 'prokersBelumTerlaksana'));
    }
    public function edit($id)
    {
        $proker = Proker::findOrFail($id);
        $proker->anggaran = number_format($proker->anggaran, 0, ',', '');
        return response()->json($proker);
    }

    public function store(Request $request)
    {
        try {
            $safeFileName = $request->nama_program;

            $proposalPath = null;
            $kepanitiaanPath = null;

            // Simpan file proposal jika ada
            if ($request->hasFile('file_proposal')) {
                $fileProposal = $request->file('file_proposal');
                $proposalFileName = $safeFileName . '_proposal.' . $fileProposal->getClientOriginalExtension();
                $fileProposal->move(public_path('upload/file-proposal'), $proposalFileName);
                $proposalPath = 'upload/file-proposal/' . $proposalFileName;
            }

            // Simpan file kepanitiaan jika ada
            if ($request->hasFile('file_kepanitiaan')) {
                $fileKepanitiaan = $request->file('file_kepanitiaan');
                $kepanitiaanFileName = $safeFileName . '_kepanitiaan.' . $fileKepanitiaan->getClientOriginalExtension();
                $fileKepanitiaan->move(public_path('upload/file-panitia'), $kepanitiaanFileName);
                $kepanitiaanPath = 'upload/file-panitia/' . $kepanitiaanFileName;
            }
            // Simpan ke database
            $proker = Proker::create([
                'nama_program' => $request->nama_program,
                'deskripsi' => $request->deskripsi,
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'tempat' => $request->tempat,
                'divisi' => $request->divisi,
                'anggaran' => $request->anggaran,
                'status' => $request->status,
                'file_proposal' => $proposalPath,
                'file_kepanitiaan' => $kepanitiaanPath,
            ]);

            toast('Data Berhasil Ditambahkan', 'success');
            return redirect()->back();

        } catch (\Exception $e) {
            toast('Gagal menyimpan data', 'error');
            return redirect()->back();
        }
    }
    public function update(Request $request)
    {
        try {
            $proker = Proker::findOrFail($request->id);

            // Ubah karakter '/' pada nomor surat agar aman untuk nama file
            $safeFileName = $request->nama_program;

            $proposalPath = $proker->file_proposal; // Default ke path lama
            $kepanitiaanPath = $proker->file_kepanitiaan; // Default ke path lama

            // Simpan file proposal jika ada
            if ($request->hasFile('file_proposal')) {
                $fileProposal = $request->file('file_proposal');
                $proposalFileName = $safeFileName . '_proposal.' . $fileProposal->getClientOriginalExtension();
                $fileProposal->move(public_path('upload/file-proposal'), $proposalFileName);
                $proposalPath = 'upload/file-proposal/' . $proposalFileName;
            }

            // Simpan file kepanitiaan jika ada
            if ($request->hasFile('file_kepanitiaan')) {
                $fileKepanitiaan = $request->file('file_kepanitiaan');
                $kepanitiaanFileName = $safeFileName . '_kepanitiaan.' . $fileKepanitiaan->getClientOriginalExtension();
                $fileKepanitiaan->move(public_path('upload/file-panitia'), $kepanitiaanFileName);
                $kepanitiaanPath = 'upload/file-panitia/' . $kepanitiaanFileName;
            }

            // Simpan ke database
            $proker->update([
                'nama_program' => $request->nama_program,
                'deskripsi' => $request->deskripsi,
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
                'tempat' => $request->tempat,
                'divisi' => $request->divisi,
                'anggaran' => $request->anggaran,
                'status' => $request->status,
                'file_proposal' => $proposalPath,
                'file_kepanitiaan' => $kepanitiaanPath,
            ]);

            toast('Data Berhasil Dirubah', 'success');
            return redirect()->back();

        } catch (\Exception $e) {
            toast('Gagal menyimpan data: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }


    public function tandaiBelumTerlaksana($id)
    {
        $proker = Proker::findOrFail($id);
        $proker->status = 'Belum Terlaksana';
        $proker->save();

        return response()->json(['message' => 'Status berhasil diubah menjadi belum terlaksana.']);
    }
    public function tandaiTerlaksana($id)
    {
        $proker = Proker::findOrFail($id);
        $proker->status = 'Terlaksana';
        $proker->save();

        return response()->json(['message' => 'Status berhasil diubah menjadi terlaksana.']);
    }

    public function hapusProker($id)
    {
        try {
            $proker = Proker::findOrFail($id);

            // Hapus file proposal jika ada
            if ($proker->file_proposal && file_exists(public_path($proker->file_proposal))) {
                unlink(public_path($proker->file_proposal));
            }

            // Hapus file kepanitiaan jika ada
            if ($proker->file_kepanitiaan && file_exists(public_path($proker->file_kepanitiaan))) {
                unlink(public_path($proker->file_kepanitiaan));
            }

            // Hapus dari database
            $proker->delete();

            toast('Data berhasil dihapus', 'success');
            return redirect()->back();

        } catch (\Exception $e) {
            toast('Gagal menghapus data: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function getFiles($id)
    {
        $proker = Proker::findOrFail($id);

        return response()->json([
            'file_proposal' => $proker->file_proposal,
            'file_kepanitiaan' => $proker->file_kepanitiaan
        ]);
    }


}
