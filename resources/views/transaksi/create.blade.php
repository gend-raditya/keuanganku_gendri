@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Transaksi</h1>

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }} ({{ $kategori->tipe }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                <input type="text" name="deskripsi" class="form-control">
            </div>

            <div class="mb-3">
                <label for="wallet_id" class="form-label">Dompet</label>
                <select name="wallet_id" id="wallet_id" class="form-select" required>
                    <option value="">-- Pilih Dompet --</option>
                    @foreach ($dompets as $dompet)
                        <option value="{{ $dompet->id }}">{{ $dompet->nama }} ({{ ucfirst($dompet->tipe) }})</option>
                    @endforeach
                </select>
            </div>




            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                <input type="number" name="jumlah" step="0.01" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
