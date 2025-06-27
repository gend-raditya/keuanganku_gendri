@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f3f8f8;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .hero-section {
            text-align: center;
            padding: 40px 20px 80px;
            margin-bottom: 10px;
            background-color: #d0f5f5;
            box-shadow: inset 0 -15px 25px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid #e0e0e0;
        }

        .dark-mode .hero-section {
            background-color: #1e1e1e;
            color: #e4e4e4;
            border-bottom: 1px solid #333;
            box-shadow: inset 0 -15px 25px rgba(255, 255, 255, 0.05);
        }

        .dark-mode .hero-section a.btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .dark-mode .hero-section a.btn-outline-success {
            color: #198754;
            border-color: #198754;
        }

        .hero-section h1 strong {
            font-weight: 800;
        }

        .fitur-img {
            max-width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .fitur-img:hover {
            transform: scale(1.02);
        }

        .fitur-text h4 {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .fitur-text p {
            font-size: 0.95rem;
            color: #555;
        }

        .section-heading {
            font-weight: 700;
            font-size: 1.8rem;
        }

        .fitur-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px 20px;
            box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
            height: 100%;
        }

        .fitur-card:hover {
            transform: translateY(-5px);
        }

        .dark-mode .fitur-card {
            background-color: #1e1e1e;
            box-shadow: inset 0 0 50px rgba(255, 255, 255, 0.05);
        }
    </style>

    <div class="hero-section text-center" data-aos="fade-down">
        <h1 class="mb-4">💸 Selamat Datang di <strong>Keuanganku</strong></h1>
        <p class="lead mb-4">Aplikasi manajemen keuangan pribadi yang membantu kamu mengelola pemasukan dan pengeluaran
            dengan mudah.</p>

        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">Masuk Sekarang</a>
        <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg px-4 ms-2">Daftar Gratis</a>
    </div>

    <!-- Fitur Ikon -->
    <div class="container py-5">
        <div class="row text-center g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="fitur-card">
                    <i class="bi bi-wallet2 fs-1 text-primary"></i>
                    <h5 class="mt-3">Pantau Saldo</h5>
                    <p>Lihat total saldo dari berbagai dompet kamu secara real-time.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="fitur-card">
                    <i class="bi bi-bar-chart-line fs-1 text-success"></i>
                    <h5 class="mt-3">Grafik Keuangan</h5>
                    <p>Visualisasi pemasukan dan pengeluaran kamu tiap bulan.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="fitur-card">
                    <i class="bi bi-shield-lock fs-1 text-danger"></i>
                    <h5 class="mt-3">Data Aman</h5>
                    <p>Data kamu terenkripsi dan hanya bisa diakses oleh kamu sendiri.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Galeri Fitur -->
    <div class="container my-5">
        <h2 class="text-center section-heading mb-5" data-aos="fade-up">📸 Fitur Unggulan dalam Gambar</h2>

        @php
            $fitur = [
                [
                    'img' => 'gambar1.jpeg',
                    'title' => '📊 Grafik Keuangan Bulanan',
                    'desc' => 'Lihat visualisasi pemasukan dan pengeluaran dalam bentuk grafik batang dan garis yang mudah dipahami.',
                    'reverse' => false,
                ],
                [
                    'img' => 'dompet.jpeg',
                    'title' => '👛 Manajemen Dompet',
                    'desc' => 'Kelola beberapa dompet sekaligus dengan saldo awal, pemasukan, dan pengeluaran masing-masing.',
                    'reverse' => true,
                ],
                [
                    'img' => 'transaksi.jpeg',
                    'title' => '🏷️ Kategori Transaksi',
                    'desc' => 'Atur pengeluaran dan pemasukan berdasarkan kategori seperti makan, gaji, transportasi, dan lainnya.',
                    'reverse' => false,
                ],
                [
                    'img' => 'gambar2.jpeg',
                    'title' => '📋 Dashboard Ringkasan',
                    'desc' => 'Semua informasi keuangan kamu dirangkum dalam satu tampilan ringkas yang informatif.',
                    'reverse' => true,
                ],
            ];
        @endphp

        @foreach ($fitur as $index => $item)
            <div class="row align-items-center mb-5 {{ $item['reverse'] ? 'flex-md-row-reverse' : '' }}" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="col-md-6 text-center mb-3 mb-md-0">
                    <img src="{{ asset('images/' . $item['img']) }}" alt="{{ $item['title'] }}" class="fitur-img">
                </div>
                <div class="col-md-6 fitur-text">
                    <h4>{{ $item['title'] }}</h4>
                    <p>{{ $item['desc'] }}</p>
                </div>
            </div>
        @endforeach
    </div>



    <!-- Testimoni -->
    <div class="container py-4" data-aos="fade-up">
        <blockquote class="blockquote text-center">
            <p class="mb-0">“Keuanganku bikin aku lebih bijak dalam mengatur pengeluaran bulanan!”</p>
            <footer class="blockquote-footer mt-2">Budi, Mahasiswa</footer>
        </blockquote>
    </div>

    <!-- Footer -->
<footer class="mt-5 pt-4 pb-3" style="background: linear-gradient(to right, #f0faff, #e0f7fa); border-top: 1px solid #ddd;">
    <div class="container text-center">
        <p class="mb-2 fw-semibold text-dark">© {{ date('Y') }} <span class="text-primary">Keuanganku</span> • By
            <a href="https://github.com/gend-raditya" class="text-decoration-none text-success fw-bold" target="_blank">
                Gendri Raditya
            </a>
        </p>
        <a href="https://github.com/gend-raditya/keuanganku" class="btn btn-outline-dark btn-sm px-3" target="_blank">
            <i class="bi bi-github me-1"></i> Lihat Proyek di GitHub
        </a>
    </div>
</footer>



@endsection

@push('scripts')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800
        });
    </script>
@endpush
