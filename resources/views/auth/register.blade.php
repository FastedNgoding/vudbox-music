@extends('layouts.auth')

@section('title', 'Register')

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
                        <h3 class="fw-bold text-foreground mt-2 mb-1">Daftar Akun Baru</h3>
                    </div>
                    <div class="d-none d-lg-block mb-4">
                        <h3 class="fw-bold text-foreground mb-1">Buat Akun Baru</h3>
                        <p class="text-white-50 small">Lengkapi data Anda untuk mendaftar</p>
                    </div>

                    <form action="{{ route('register.store') }}" method="POST" id="registerForm">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label small fw-semibold text-white-50">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary border-0 text-accent"><i class="bx bx-user"></i></span>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control bg-primary text-foreground border-0 py-2" 
                                       placeholder="Nama Anda" 
                                       required 
                                       autocomplete="name"
                                       value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label small fw-semibold text-white-50">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary border-0 text-accent"><i class="bx bx-at"></i></span>
                                <input type="text" 
                                       name="username" 
                                       id="username" 
                                       class="form-control bg-primary text-foreground border-0 py-2" 
                                       placeholder="username_unik" 
                                       required 
                                       autocomplete="username"
                                       value="{{ old('username') }}">
                            </div>
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label small fw-semibold text-white-50">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary border-0 text-accent"><i class="bx bx-envelope"></i></span>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       class="form-control bg-primary text-foreground border-0 py-2" 
                                       placeholder="nama@email.com" 
                                       required 
                                       autocomplete="email"
                                       value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label small fw-semibold text-white-50">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary border-0 text-accent"><i class="bx bx-lock"></i></span>
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       class="form-control bg-primary text-foreground border-0 py-2" 
                                       placeholder="Min. 8 karakter" 
                                       required 
                                       autocomplete="new-password">
                                <button class="btn btn-outline-secondary bg-primary border-0 text-white-50" type="button" id="togglePassword">
                                    <i class="bx bx-eye-slash"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label small fw-semibold text-white-50">Konfirmasi Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary border-0 text-accent"><i class="bx bx-check-shield"></i></span>
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       class="form-control bg-primary text-foreground border-0 py-2" 
                                       placeholder="Ulangi kata sandi" 
                                       required 
                                       autocomplete="new-password">
                                <button class="btn btn-outline-secondary bg-primary border-0 text-white-50" type="button" id="toggleConfirmPassword">
                                    <i class="bx bx-eye-slash"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="terms" id="terms" class="form-check-input bg-primary border-0" style="cursor: pointer;" required>
                                <label class="form-check-label small text-white-50 ms-1" for="terms" style="cursor: pointer; user-select: none;">
                                    Saya menyetujui Ketentuan Layanan & Kebijakan Privasi.
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn bg-accent text-primary w-100 fw-bold py-2 rounded-3 hover-scale border-0">
                            Daftar Sekarang
                        </button>

                        <div class="text-center mt-4">
                            <p class="small text-white-50 mb-0">
                                Sudah punya akun? 
                                <a href="{{ url('login') }}" class="text-accent text-decoration-none fw-semibold ms-1">Masuk di sini</a>
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

        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPasswordInput = document.querySelector('#password_confirmation');
        const confirmIcon = toggleConfirmPassword.querySelector('i');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            if (type === 'password') {
                confirmIcon.className = 'bx bx-eye-slash';
            } else {
                confirmIcon.className = 'bx bx-eye';
            }
        });
    });
</script>
@endsection
