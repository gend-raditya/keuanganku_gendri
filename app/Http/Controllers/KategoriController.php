<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'tipe' => 'required|in:pemasukan,pengeluaran'
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->delete();
        return back()->with('success', 'Kategori dihapus.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:pemasukan,pengeluaran'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->only(['nama', 'tipe']));

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }
}
