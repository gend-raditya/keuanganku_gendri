<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dompet;
use Illuminate\Support\Facades\Auth;

class DompetController extends Controller
{
    public function index()
    {
        $dompets = Dompet::where('user_id', Auth::id())->get();
        return view('dompet.index', compact('dompets'));
    }

    public function create()
    {
        return view('dompet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:cash,bank,e-wallet',
            'saldo_awal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        Dompet::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'tipe' => $request->tipe,
            'saldo_awal' => $request->saldo_awal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('dompet.index')->with('success', 'Dompet berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $dompet = Dompet::where('user_id', Auth::id())->findOrFail($id);
        return view('dompet.edit', compact('dompet'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:cash,bank,e-wallet',
            'saldo_awal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        $dompet = Dompet::where('user_id', Auth::id())->findOrFail($id);
        $dompet->update($request->all());

        return redirect()->route('dompet.index')->with('success', 'Dompet berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $dompet = Dompet::where('user_id', Auth::id())->findOrFail($id);
        $dompet->delete();

        return redirect()->route('dompet.index')->with('success', 'Dompet berhasil dihapus!');
    }
}
