<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::with('kategori','dompet')->latest()->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $dompets = \App\Models\Dompet::where('user_id', Auth::id())->get(); // ambil dompet milik user


        return view('transaksi.create', compact('kategoris', 'dompets'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|numeric',
            'kategori_id' => 'required|exists:gendri_kategoris,id',
            'wallet_id' => 'required|exists:gendri_dompet,id',
        ]);

        Transaksi::create([
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'kategori_id' => $request->kategori_id,
            'wallet_id' => $request->wallet_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $kategoris = Kategori::all();
        $dompets = \App\Models\Dompet::where('user_id', Auth::id())->get();

        return view('transaksi.edit', compact('transaksi', 'kategoris', 'dompets'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:gendri_kategoris,id',
            'wallet_id' => 'required|exists:gendri_dompet,id',
            'jumlah' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
            'wallet_id' => $request->wallet_id,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $transaksi = \App\Models\Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
