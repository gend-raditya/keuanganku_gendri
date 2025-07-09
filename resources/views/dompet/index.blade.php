@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-dark">Dompet Saya</h2>
        <a href="{{ route('dompet.create') }}" class="btn btn-warning text-dark fw-semibold shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Dompet
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table align-middle mb-0" style="color: #3a3a3a;">
            <thead style="background-color: #f9f3e9; border-bottom: 2px solid #e0d2ba;">
                <tr>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Saldo Awal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dompets as $dompet)
                    <tr style="background-color: #fffdf9;">
                        <td>{{ $dompet->nama }}</td>
                        <td><span class="badge bg-light text-dark border border-secondary-subtle px-3 py-2">{{ ucfirst($dompet->tipe) }}</span></td>
                        <td class="text-success fw-semibold">Rp {{ number_format($dompet->saldo_awal, 0, ',', '.') }}</td>
                        <td>{{ $dompet->keterangan }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('dompet.edit', $dompet->id) }}" class="btn btn-outline-warning btn-sm text-dark border-2">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('dompet.destroy', $dompet->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus dompet ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm border-2">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">📭 Belum ada dompet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
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

    .btn-outline-warning:hover {
        background-color: #f6d365;
        color: #000;
    }

    .btn-outline-danger:hover {
        background-color: #e74c3c;
        color: #fff;
    }

    .table-responsive table {
        border: 1px solid #ede3d4;
    }

    .alert-success {
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }
      body.dark-mode h2.text-dark {
        color: #f1f1f1 !important;
    }
</style>
@endsection
