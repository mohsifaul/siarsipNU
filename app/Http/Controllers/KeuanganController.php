<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $transaksi = Keuangan::orderBy('tanggal', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();
        return view('pages.keuangan.main', compact('transaksi'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|integer|min:1',
        ]);

        Keuangan::create($request->only(['tanggal', 'keterangan', 'jenis', 'jumlah']));

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
