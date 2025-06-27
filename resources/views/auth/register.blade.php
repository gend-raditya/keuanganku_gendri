@extends('layouts.app')

@section('content')
<style>
    .register-container {
        min-height: 90vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .register-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
        padding: 40px 30px;
        background-color: #ffffff;
    }

    .register-card h3 {
        font-weight: 700;
        margin-bottom: 25px;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary {
        width: 100%;
        font-weight: 600;
    }

    body.dark-mode .register-card {
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

<div class="container register-container">
    <div class="col-md-6">
        <div class="register-card">
            <h3 class="text-center">📝 Daftar Akun <span class="text-primary">Keuanganku</span></h3>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">👤 Nama Lengkap</label>
                    <input id="name" type="text"
                        class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">📧 Email</label>
                    <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">🔒 Kata Sandi</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">🔁 Konfirmasi Kata Sandi</label>
                    <input id="password-confirm" type="password" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
                </div>

                <!-- Submit -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Daftar Sekarang
                    </button>
                </div>

                 <div class="text-center mt-3">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Login</a>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
