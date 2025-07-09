@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0 text-dark">Daftar Transaksi</h1>
            <a href="{{ route('transaksi.create') }}" class="btn btn-warning text-dark fw-semibold shadow-sm">
                ➕ Tambah Transaksi
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0 rounded-4" style="background-color: #fffaf3;">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0" style="color: #3a3a3a;">
                    <thead style="background-color: #f9f5ee;">
                        <tr style="border-bottom: 2px solid #e1d7c6;">
                            <th style="width: 15%;">Tanggal</th>
                            <th style="width: 20%;">Kategori</th>
                            <th style="width: 20%;">Dompet</th>
                            <th>Deskripsi</th>
                            <th style="width: 15%;">Jumlah</th>
                            <th class="text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksi as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                <td>
                                    <strong>{{ $item->kategori->nama }}</strong><br>
                                    <small class="text-{{ $item->kategori->tipe == 'pengeluaran' ? 'danger' : 'success' }}">
                                        {{ ucfirst($item->kategori->tipe) }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge rounded-pill border border-warning-subtle bg-light text-dark px-3 py-2">
                                        {{ $item->dompet->nama ?? '-' }}<br>
                                        <small class="text-muted">{{ ucfirst($item->dompet->tipe ?? '') }}</small>
                                    </span>
                                </td>
                                <td>{{ $item->deskripsi ?? '-' }}</td>
                                <td class="fw-bold text-{{ $item->kategori->tipe == 'pengeluaran' ? 'danger' : 'success' }}">
                                    Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('transaksi.edit', $item->id) }}" class="text-warning me-2" title="Edit">
                                        <i class="bi bi-pencil-square fs-5"></i>
                                    </a>
                                    <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 text-danger" title="Hapus"
                                            onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">📭 Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f9f5f0;
        }

        .table-hover tbody tr:hover {
            background-color: #fff6e5;
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

        .card {
            border: 1px solid #f0e6d6;
        }
    </style>
@endsection
