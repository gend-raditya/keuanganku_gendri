@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Daftar Kategori</h1>
         @if(Auth::user()->role === 'admin')
        <a href="{{ route('kategori.create') }}" class="btn btn-success">➕ Tambah Kategori</a>
         @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($kategoris->isEmpty())
        <div class="alert alert-warning">Belum ada kategori.</div>
    @else
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Jenis</th>
                           @if(Auth::user()->role === 'admin')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoris as $index => $kategori)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kategori->nama }}</td>
                                <td>
                                    <span style="color: {{ $kategori->tipe === 'pemasukan' ? '#198754' : '#dc3545' }}">
                                        {{ ucfirst($kategori->tipe) }}
                                    </span>
                                </td>
                                <td class="d-flex gap-2">
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="text-primary" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form method="POST" action="{{ route('kategori.destroy', $kategori->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 text-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
