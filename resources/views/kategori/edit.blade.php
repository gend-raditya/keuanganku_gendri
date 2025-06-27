@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>

    <form method="POST" action="{{ route('kategori.update', $kategori->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $kategori->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Jenis</label>
            <select name="tipe" id="tipe" class="form-select" required>
                <option value="pemasukan" {{ $kategori->tipe == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                <option value="pengeluaran" {{ $kategori->tipe == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
