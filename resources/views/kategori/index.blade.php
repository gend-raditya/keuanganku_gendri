@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0 text-dark">Daftar Kategori</h1>
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('kategori.create') }}" class="btn btn-warning text-dark fw-semibold shadow-sm">
                    ➕ Tambah Kategori
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
        @endif

        @if ($kategoris->isEmpty())
            <div class="alert alert-warning shadow-sm rounded-3 bg-light text-dark">📭 Belum ada kategori.</div>
        @else
            <div class="card shadow-sm border-0 rounded-4" style="background-color: #fffaf3;">
                <div class="card-body p-0">
                    <table class="table align-middle mb-0" style="color: #3a3a3a;">
                        <thead style="background-color: #f9f3e9; border-bottom: 2px solid #e0d2ba;">
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Jenis</th>
                                @if (Auth::user()->role === 'admin')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategoris as $index => $kategori)
                                <tr style="background-color: #fffdf9;">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kategori->nama }}</td>
                                    <td>
                                        <span class="fw-semibold"
                                            style="color: {{ $kategori->tipe === 'pemasukan' ? '#2e8b57' : '#c0392b' }}">
                                            {{ ucfirst($kategori->tipe) }}
                                        </span>
                                    </td>
                                    @if (Auth::user()->role === 'admin')
                                        <td class="d-flex gap-2">
                                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="text-warning"
                                                title="Edit">
                                                <i class="bi bi-pencil-square fs-5"></i>
                                            </a>

                                            <form method="POST" action="{{ route('kategori.destroy', $kategori->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 text-danger" title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                    <i class="bi bi-trash fs-5"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <style>
        body {
            background-color: #f9f5f0;
        }

        .btn-warning {
            background-color: #f6d365;
            border: none;
        }

        .btn-warning:hover {
            background-color: #f4c14d;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .alert-warning {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
        }

        .card {
            border: 1px solid #ede3d4;
        }

        .table tbody tr:hover {
            background-color: #fff6e5;
        }

         body.dark-mode h1.text-dark {
        color: #f1f1f1 !important;
    }
    </style>
@endsection
