@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Daftar Transaksi</h1>
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary">➕ Tambah Transaksi</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
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
                                    <span class="badge text-bg-light">
                                        {{ $item->dompet->nama ?? '-' }}
                                        <br>
                                        <small class="text-muted">{{ ucfirst($item->dompet->tipe ?? '') }}</small>
                                    </span>
                                </td>
                                <td>{{ $item->deskripsi ?? '-' }}</td>
                                <td class="fw-bold text-{{ $item->kategori->tipe == 'pengeluaran' ? 'danger' : 'success' }}">
                                    Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('transaksi.edit', $item->id) }}" class="text-primary me-2" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 text-danger" title="Hapus"
                                            onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            <i class="bi bi-trash"></i>
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
@endsection
