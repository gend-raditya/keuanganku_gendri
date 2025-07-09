@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Edit Dompet</h2>

    <form method="POST" action="{{ route('dompet.update', $dompet->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Dompet</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama', $dompet->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <select name="tipe" class="form-select" required>
                <option value="bank" {{ $dompet->tipe === 'bank' ? 'selected' : '' }}>Bank</option>
                <option value="cash" {{ $dompet->tipe === 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="e-wallet" {{ $dompet->tipe === 'e-wallet' ? 'selected' : '' }}>E-Wallet</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="saldo_awal" class="form-label">Saldo Awal</label>
            <input type="number" class="form-control" name="saldo_awal" value="{{ old('saldo_awal', $dompet->saldo_awal) }}" min="0" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan" rows="3">{{ old('keterangan', $dompet->keterangan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('dompet.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
