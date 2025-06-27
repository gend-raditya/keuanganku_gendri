@extends('layouts.app')

@section('content')
    <style>
        .login-container {
            min-height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
            padding: 40px 30px;
            background-color: #ffffff;
        }

        .login-card h3 {
            font-weight: 700;
            margin-bottom: 25px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
        }

        .form-check-label {
            font-size: 0.9rem;
        }

        .btn-primary {
            width: 100%;
            font-weight: 600;
        }

        .btn-link {
            font-size: 0.9rem;
        }

        body.dark-mode .login-card {
            background-color: #1e1e1e;
            color: #e4e4e4;
        }

        body.dark-mode .form-control {
            background-color: #2c2c2c;
            color: #e4e4e4;
            border-color: #444;
        }

        body.dark-mode .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
        }

        body.dark-mode .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>

    <div class="container login-container">
        <div class="col-md-6">
            <div class="login-card">
                <h3 class="text-center">🔐 Masuk ke <span class="text-primary">Keuanganku</span></h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">📧 Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">🔒 Kata Sandi</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Ingat Saya
                        </label>
                    </div>

                    <!-- Button -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            Masuk
                        </button>
                    </div>

                  <!-- Atau login dengan Google -->
                    <div class="text-center mb-3">
                        <span class="text-muted">atau</span>
                    </div>

                    <div class="d-grid mb-3">
                        <a href="{{ url('/auth/google') }}" class="btn btn-outline-danger fw-semibold">
                            <i class="bi bi-google me-2"></i> Masuk dengan Google
                        </a>
                    </div>


                    <div class="text-center mt-3">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Daftar sekarang</a>
                    </div>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Lupa kata sandi?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
