@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #d7cca9;
            color: #1c1c1c;
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            /* Navy gradient */
            color: #ffffff;
            padding: 60px 20px 100px;
            box-shadow: inset 0 -15px 25px rgba(0, 0, 0, 0.2);
            border-bottom: none;
        }

        .dark-mode .hero-section {
            background: linear-gradient(to right, #1a1a1a, #2e2e2e);
            color: #e0e0e0;
        }

        .hero-section a.btn-primary {
            background-color: #d4af37;
            /* Gold */
            border: none;
            color: #fff;
        }

        .hero-section a.btn-outline-success {
            color: #d4af37;
            border: 2px solid #d4af37;
        }

        .fitur-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .dark-mode .fitur-card {
            background-color: #2c2c2c;
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.05);
            color: #e0e0e0;
        }

        .fitur-card:hover {
            transform: translateY(-6px);
        }

        .fitur-img {
            width: 100%;
            max-width: 500px;
            max-height: 300px;
            object-fit: cover;
            border-radius: 16px;
            border: 3px solid #d4af37;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }


        .section-heading {
            color: #0f2027;
            font-weight: 700;
            font-size: 2rem;
        }

        .blockquote-footer {
            color: #555;
            font-style: italic;
        }

        footer {
            background: #6b9baf;
            color: #f0f0f0;
        }

        footer a {
            color: #d4af37;
        }

        footer a.btn-outline-dark {
            border-color: #d4af37;
            color: #d4af37;
        }

        footer a.btn-outline-dark:hover {
            background-color: #d4af37;
            color: #fff;
        }

        .dark-mode .fitur-heading {
            color: #f0d152;
            /* warna emas atau bisa kamu sesuaikan */
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
        <h2 class="text-center section-heading fitur-heading mb-5" data-aos="fade-up">📸 Fitur Unggulan dalam Gambar</h2>

        @php
            $fitur = [
                [
                    'img' => 'gambar1.jpeg',
                    'title' => '📊 Grafik Keuangan Bulanan',
                    'desc' =>
                        'Lihat visualisasi pemasukan dan pengeluaran dalam bentuk grafik batang dan garis yang mudah dipahami.',
                    'reverse' => false,
                ],
                [
                    'img' => 'dompet.jpeg',
                    'title' => '👛 Manajemen Dompet',
                    'desc' =>
                        'Kelola beberapa dompet sekaligus dengan saldo awal, pemasukan, dan pengeluaran masing-masing.',
                    'reverse' => true,
                ],
                [
                    'img' => 'transaksi.jpeg',
                    'title' => '🏷️ Kategori Transaksi',
                    'desc' =>
                        'Atur pengeluaran dan pemasukan berdasarkan kategori seperti makan, gaji, transportasi, dan lainnya.',
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
            <div class="row align-items-center mb-5 {{ $item['reverse'] ? 'flex-md-row-reverse' : '' }}" data-aos="fade-up"
                data-aos-delay="{{ ($index + 1) * 100 }}">
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
    <footer class="mt-5 pt-4 pb-3"
        style="background: linear-gradient(to right, #f0faff, #e0f7fa); border-top: 1px solid #ddd;">
        <div class="container text-center">
            <p class="mb-2 fw-semibold text-dark">© {{ date('Y') }} <span class="text-primary">Keuanganku</span> • By
                <a href="https://github.com/gend-raditya" class="text-decoration-none text-success fw-bold" target="_blank">
                    Gendri Raditya
                </a>
            </p>
            <a href="https://github.com/gend-raditya/keuanganku_gendri" class="btn btn-outline-dark btn-sm px-3"
                target="_blank">
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
