<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function create()
    {
        return view('pages.inventaris.tambah');
    }

    /**
     * Simpan data barang inventaris baru.
     */
    public function store(Request $request)
    {
        // Ambil data dasar
        $jumlah = (int) $request->jumlah; // pastikan integer

        // ✅ Validasi dasar (required) secara manual
        $errors = [];

        if (empty($request->nama_barang))
            $errors['nama_barang'] = 'Nama barang wajib diisi.';
        if (empty($request->kategori))
            $errors['kategori'] = 'Kategori wajib dipilih.';
        if ($jumlah < 1)
            $errors['jumlah'] = 'Jumlah minimal 1.';
        if (empty($request->satuan))
            $errors['satuan'] = 'Satuan wajib dipilih.';
        if (empty($request->penanggung_jawab))
            $errors['penanggung_jawab'] = 'Penanggung jawab wajib diisi.';

        // ✅ Jika jumlah == 1 → kondisi wajib diisi
        if ($jumlah == 1 && empty($request->kondisi)) {
            $errors['kondisi'] = 'Pilih kondisi barang.';
        }

        // Jika ada error, kembalikan
        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        // ✅ Jika jumlah > 1 → validasi total jumlah per kondisi
        if ($jumlah > 1) {
            $jumlah_baik = (int) ($request->jumlah_baik ?? 0);
            $jumlah_perbaikan = (int) ($request->jumlah_perbaikan ?? 0);
            $jumlah_rusak = (int) ($request->jumlah_rusak ?? 0);

            $totalKondisi = $jumlah_baik + $jumlah_perbaikan + $jumlah_rusak;

            if ($totalKondisi !== $jumlah) {
                return back()
                    ->withErrors(['jumlah_kondisi' => 'Total jumlah kondisi (Baik + Perlu Perbaikan + Rusak) harus sama dengan jumlah barang.'])
                    ->withInput();
            }
        }

        // ✅ Simpan ke database
        Inventaris::create([
            'nama_barang' => $request->nama_barang ?? '-',
            'kategori' => $request->kategori ?? '-',
            'jumlah' => $jumlah,
            'satuan' => $request->satuan ?? '-',
            'kondisi' => $jumlah == 1 ? ($request->kondisi ?? '-') : null, // hanya isi jika jumlah = 1
            'penanggung_jawab' => $request->penanggung_jawab ?? '-',
            'keterangan' => $request->keterangan ?? '-',
            'jumlah_baik' => $jumlah > 1 ? ($request->jumlah_baik ?? 0) : null,
            'jumlah_perbaikan' => $jumlah > 1 ? ($request->jumlah_perbaikan ?? 0) : null,
            'jumlah_rusak' => $jumlah > 1 ? ($request->jumlah_rusak ?? 0) : null,
        ]);

        toast('Data berhasil Ditambahkan', 'success');
        return redirect()->route('inventaris');
        // return redirect()->back();
    }

    /**
     * Tampilkan daftar barang inventaris.
     */
    public function index()
    {
        $inventaris = Inventaris::all();
        return view('pages.inventaris.main', compact('inventaris'));
    }

    /**
     * Tampilkan detail barang inventaris.
     */
    public function show(Inventaris $inventari)
    {
        return view('inventaris.show', compact('inventari'));
    }

    /**
     * Tampilkan form untuk mengedit barang inventaris.
     */
    public function edit(Inventaris $inventari)
    {
        return view('inventaris.edit', compact('inventari'));
    }

    /**
     * Update data barang inventaris.
     */
    public function update(Request $request, Inventaris $inventari)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'satuan' => 'required|string|max:50',
            'harga_per_unit' => 'required|numeric',
            'lokasi' => 'required|string|max:255',
            'kondisi' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        $inventari->update($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Barang inventaris berhasil diperbarui.');
    }

    /**
     * Hapus barang inventaris.
     */
    public function hapusInventaris($id)
    {
        try {
            $inventaris = Inventaris::findOrFail($id);

            // Hapus dari database
            $inventaris->delete();

            toast('Data berhasil dihapus', 'success');
            return redirect()->back();

        } catch (\Exception $e) {
            toast('Gagal menghapus data: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function cetakPdf()
    {
        // Ambil field yang diperlukan sesuai model Inventaris
        $items = Inventaris::select(['id', 'nama_barang', 'kategori', 'jumlah', 'kondisi', 'jumlah_baik', 'jumlah_perbaikan', 'jumlah_rusak', 'keterangan', 'penanggung_jawab'])
            ->orderBy('nama_barang', 'asc')
            ->get();

        // Hitung total jumlah dan total item untuk footer/summary
        $totalJumlah = $items->sum('jumlah');
        $totalItems = $items->count();

        // Render view PDF dengan data
        $pdf = Pdf::loadView('pages.inventaris.cetak', compact('items', 'totalJumlah', 'totalItems'))
            ->setPaper('a4', 'portrait');

        // Pastikan header Content-Disposition = inline agar browser menampilkan preview (tidak langsung download)
        $pdfContent = $pdf->output();

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="inventaris_preview_' . now()->format('Ymd_His') . '.pdf"',
        ]);
    }
}
