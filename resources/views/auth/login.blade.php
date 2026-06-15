@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-9">
        <div class="card bg-secondary border-0 rounded-4 shadow-lg overflow-hidden">
            <div class="row g-0">
                <div class="col-lg-6 bg-linear-primary d-none d-lg-flex flex-column justify-content-center align-items-center text-center p-5 text-white">
                    <img src="{{ url('logo.png') }}" alt="VudBox Logo" width="80" height="80" class="mb-3 hover-scale">
                    <h2 class="display-6 fw-bold mb-2">VudBox</h2>
                    <p class="opacity-75 px-4 mb-0">Eksplorasi musik independen dari berbagai kreator orisinal secara gratis.</p>
                </div>
                <div class="col-12 col-lg-6 p-4 p-md-5">
                    <div class="text-center d-lg-none mb-4">
                        <img src="{{ url('logo.png') }}" alt="VudBox Logo" width="50" height="50" class="mb-2 hover-scale">
                        <h3 class="fw-bold text-foreground mt-2 mb-1">Masuk ke VudBox</h3>
                    </div>
                    <div class="d-none d-lg-block mb-4">
                        <h3 class="fw-bold text-foreground mb-1">Selamat Datang Kembali</h3>
                        <p class="text-white-50 small">Silakan masuk untuk melanjutkan</p>
                    </div>

                    <form action="{{ route('login.store') }}" method="POST" id="loginForm">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label small fw-semibold text-white-50">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary border-0 text-accent">
                                    <i class="bx bx-user"></i>
                                </span>
                                <input type="text" name="username" id="username" class="form-control bg-primary text-foreground border-0 py-2"  placeholder="xjsn"  required  autocomplete="username" value="{{ old('username') }}">
                            </div>
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label small fw-semibold text-white-50 mb-0">Kata Sandi</label>
                                <a href="#" class="small text-accent text-decoration-none">Lupa sandi?</a>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-primary border-0 text-accent">
                                    <i class="bx bx-lock"></i>
                                </span>
                                <input type="password" name="password" id="password" class="form-control bg-primary text-foreground border-0 py-2" placeholder="••••••••" required autocomplete="current-password">
                                <button class="btn btn-outline-secondary bg-primary border-0 text-white-50" type="button" id="togglePassword">
                                    <i class="bx bx-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input bg-primary border-0" style="cursor: pointer;">
                                <label class="form-check-label small text-white-50 ms-1" for="remember" style="cursor: pointer; user-select: none;">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn bg-accent text-primary w-100 fw-bold py-2 rounded-3 hover-scale border-0">
                            Masuk Sekarang
                        </button>

                        <div class="text-center mt-4">
                            <p class="small text-white-50 mb-0">
                                Belum punya akun? 
                                <a href="{{ url('register') }}" class="text-accent text-decoration-none fw-semibold ms-1">Daftar di sini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            if (type === 'password') {
                icon.className = 'bx bx-eye-slash';
            } else {
                icon.className = 'bx bx-eye';
            }
        });
    });
</script>
@endsection
