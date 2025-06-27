@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Edit Transaksi</h2>

        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $transaksi->tanggal) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select name="kategori_id" class="form-select" required>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ $transaksi->kategori_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }} ({{ $kategori->tipe }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control"
                    value="{{ old('deskripsi', $transaksi->deskripsi) }}">
            </div>

            <div class="mb-3">
                <label for="wallet_id" class="form-label">Dompet</label>
                <select name="wallet_id" id="wallet_id" class="form-select" required>
                    <option value="">-- Pilih Dompet --</option>
                    @foreach ($dompets as $dompet)
                        <option value="{{ $dompet->id }}" {{ $dompet->id == $transaksi->wallet_id ? 'selected' : '' }}>
                            {{ $dompet->nama }} ({{ ucfirst($dompet->tipe) }})
                        </option>
                    @endforeach
                </select>
            </div>



            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $transaksi->jumlah) }}"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
