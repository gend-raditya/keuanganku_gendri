@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Dashboard Keuangan</h2>

        <!-- Ringkasan Saldo -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total Pemasukan</h5>
                        <p class="card-text">Rp {{ number_format($pemasukan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total Pengeluaran</h5>
                        <p class="card-text">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Saldo</h5>
                        <p class="card-text">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <form method="GET" class="row g-3 mb-4 align-items-end">
            <div class="col-md-4">
                <label for="tahun" class="form-label">Tahun</label>
                <select name="tahun" class="form-select">
                    @foreach ($tahunTersedia as $tahun)
                        <option value="{{ $tahun }}" {{ $tahun == $tahunDipilih ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="chart" class="form-label">Jenis Grafik</label>
                <select name="chart" class="form-select">
                    <option value="bar" {{ $tipeChart == 'bar' ? 'selected' : '' }}>Bar</option>
                    <option value="line" {{ $tipeChart == 'line' ? 'selected' : '' }}>Line</option>
                    <option value="pie" {{ $tipeChart == 'pie' ? 'selected' : '' }}>Pie</option>
                </select>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary w-100">Tampilkan</button>
            </div>
        </form>

        <!-- Ringkasan Dompet dan Grafik dalam 2 kolom -->
        <div class="row g-4">
            <!-- Ringkasan Dompet -->
            <div class="col-lg-6">
                <div class="card shadow-sm rounded-4 border-0 h-100">
                    <div class="card-header bg-info text-white rounded-top-4">
                        <h5 class="mb-0">💼 Ringkasan Dompet</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Nama Dompet</th>
                                        <th>Pemasukan</th>
                                        <th>Pengeluaran</th>
                                        <th>Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ringkasanDompet as $dompet)
                                        <tr @if ($dompet['is_minim']) class="table-warning" @endif>
                                            <td>
                                                {{ $dompet['nama'] }}
                                                @if ($dompet['is_minim'])
                                                    <span class="badge bg-danger ms-2">⚠️ Saldo minim</span>
                                                @endif
                                            </td>
                                            <td class="text-success">Rp
                                                {{ number_format($dompet['pemasukan'], 0, ',', '.') }}</td>
                                            <td class="text-danger">Rp
                                                {{ number_format($dompet['pengeluaran'], 0, ',', '.') }}</td>
                                            <td class="fw-bold">Rp {{ number_format($dompet['saldo'], 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Tidak ada dompet tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            


            <!-- Grafik Keuangan -->
            <div class="col-lg-6">
                <div class="card shadow-sm rounded-4 border-0 h-100">
                    <div class="card-header bg-secondary text-white rounded-top-4">
                        <h5 class="mb-0">📊 Grafik Keuangan Tahun {{ $tahunDipilih }}</h5>
                    </div>
                    <div class="card-body bg-light rounded-bottom-4">
                        <canvas id="grafikKeuangan" style="height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('grafikKeuangan').getContext('2d');
        const chartType = '{{ $tipeChart }}';

        const config = {
            type: chartType === 'pie' ? 'pie' : chartType,
            data: {
                labels: {!! json_encode($bulanLabels) !!},
                datasets: chartType === 'pie' ? [{
                    label: 'Total Transaksi',
                    data: {!! json_encode($pieData) !!},
                    backgroundColor: {!! json_encode(
                        $bulanLabels->map(function ($b, $i) {
                            return 'hsl(' . $i * 30 . ',70%,60%)';
                        }),
                    ) !!}
                }] : [{
                        label: 'Pemasukan',
                        data: {!! json_encode($pemasukanData) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        fill: chartType === 'line',
                        tension: 0.3
                    },
                    {
                        label: 'Pengeluaran',
                        data: {!! json_encode($pengeluaranData) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        fill: chartType === 'line',
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: chartType !== 'pie' ? {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 50000
                        }
                    }
                } : {},
                plugins: {
                    legend: {
                        position: chartType === 'pie' ? 'right' : 'top'
                    }
                }
            }
        };

        new Chart(ctx, config);
    </script>
@endsection
