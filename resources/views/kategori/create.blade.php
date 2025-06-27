@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kategori</h1>
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" name="nama" id="nama" placeholder="Nama Kategori" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Jenis</label>
            <select name="tipe" id="tipe" class="form-select" required>
                <option value="pemasukan">Pemasukan</option>
                <option value="pengeluaran">Pengeluaran</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
