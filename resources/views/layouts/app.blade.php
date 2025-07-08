<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">


    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body.dark-mode {
            background-color: #121212;
            color: #e4e4e4;
        }

        .dark-mode .navbar,
        .dark-mode .dropdown-menu {
            background-color: #1e1e1e !important;
        }

        .dark-mode .nav-link,
        .dark-mode .dropdown-item {
            color: #e4e4e4 !important;
        }

        .dark-mode .navbar-brand {
            color: #ffffff !important;
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }
         /* Animated logo */
        .logo-video {
            height: 40px;
            width: auto;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                    <video autoplay muted loop playsinline class="logo-video">
                        <source src="{{ asset('images/logo2.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <span>Keuanganku</span>
                </a>



                <!-- Toggle button (mobile) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('transaksi.index') }}">Transaksi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('kategori.index') }}">Kategori</a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Dark mode toggle -->
                        <li class="nav-item me-2">
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input" type="checkbox" id="toggleDarkNav">
                            </div>
                        </li>

                        <!-- Hanya tampilkan nama & logout jika user login -->

                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Dark mode logic -->
    <script>
        const darkToggle = document.getElementById('toggleDarkNav');
        const darkClass = 'dark-mode';

        // Simpan preferensi di localStorage
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add(darkClass);
            if (darkToggle) darkToggle.checked = true;
        }

        if (darkToggle) {
            darkToggle.addEventListener('change', function() {
                document.body.classList.toggle(darkClass);
                localStorage.setItem('theme', document.body.classList.contains(darkClass) ? 'dark' : 'light');
            });
        }
    </script>

    @yield('scripts')
    @stack('scripts')

</body>

</html>
