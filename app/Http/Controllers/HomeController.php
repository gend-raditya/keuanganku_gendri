<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Dompet;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $userId = Auth::id();


        $tahunDipilih = $request->input('tahun') ?? date('Y');
        $tipeChart = $request->input('chart', 'bar'); // default 'bar'

        $pemasukan = Transaksi::where('user_id', $userId)
            ->whereHas('kategori', fn($q) => $q->where('tipe', 'pemasukan'))
            ->sum('jumlah');

        $pengeluaran = Transaksi::where('user_id', $userId)
            ->whereHas('kategori', fn($q) => $q->where('tipe', 'pengeluaran'))
            ->sum('jumlah');

        $saldo = $pemasukan - $pengeluaran;

        //RINGKASAN DOMPET

        // RINGKASAN DOMPET
        $ringkasanDompet = Dompet::with(['transaksis.kategori'])
            ->where('user_id', $userId)
            ->get()
            ->map(function ($dompet) {
                $pemasukan = $dompet->transaksis->where('kategori.tipe', 'pemasukan')->sum('jumlah');
                $pengeluaran = $dompet->transaksis->where('kategori.tipe', 'pengeluaran')->sum('jumlah');
                $saldo = $dompet->saldo_awal + $pemasukan - $pengeluaran;

                return [
                    'nama' => $dompet->nama,
                    'pemasukan' => $pemasukan,
                    'pengeluaran' => $pengeluaran,
                    'saldo' => $saldo,
                    'is_minim' => $saldo < 10000 // Saldo minim jika di bawah 10.000
                ];
            });


        $dataBulanan = Transaksi::selectRaw("MONTH(gendri_transaksis.tanggal) as bulan, SUM(gendri_transaksis.jumlah) as total, gendri_kategoris.tipe")
            ->join('gendri_kategoris', 'gendri_transaksis.kategori_id', '=', 'gendri_kategoris.id')
            ->where('gendri_transaksis.user_id', $userId)
            ->whereYear('gendri_transaksis.tanggal', $tahunDipilih)
            ->groupBy('bulan', 'gendri_kategoris.tipe')
            ->orderBy('bulan')
            ->get();

        $bulanLabels = collect(range(1, 12))->map(fn($b) => date('F', mktime(0, 0, 0, $b, 1)));
        $pemasukanData = collect(range(1, 12))->map(function ($b) use ($dataBulanan) {
            return $dataBulanan->where('bulan', $b)->where('tipe', 'pemasukan')->first()->total ?? 0;
        });

        $pengeluaranData = collect(range(1, 12))->map(function ($b) use ($dataBulanan) {
            return $dataBulanan->where('bulan', $b)->where('tipe', 'pengeluaran')->first()->total ?? 0;
        });

        // Saldo Bulanan (akumulasi per bulan)
        $saldoBulanan = [];
        $saldoSementara = 0;

        for ($i = 0; $i < 12; $i++) {
            $saldoSementara += $pemasukanData[$i] - $pengeluaranData[$i];
            $saldoBulanan[] = $saldoSementara;
        }


        $pieData = collect(range(1, 12))->map(function ($b) use ($pemasukanData, $pengeluaranData) {
            return ($pemasukanData[$b - 1] ?? 0) + ($pengeluaranData[$b - 1] ?? 0);
        });


        // Untuk dropdown tahun
        $tahunTersedia = Transaksi::selectRaw('YEAR(tanggal) as tahun')
            ->where('user_id', $userId)
            ->groupBy('tahun')
            ->pluck('tahun');

        return view('home', compact('pemasukan', 'pengeluaran', 'saldo', 'bulanLabels', 'pemasukanData', 'pengeluaranData', 'tahunTersedia', 'tahunDipilih', 'tipeChart', 'pieData', 'ringkasanDompet', 'saldoBulanan'));
    }
}
