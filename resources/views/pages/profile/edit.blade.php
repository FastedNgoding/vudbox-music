@extends('layouts.app')

@section('content')
<div class="row justify-content-center m-0 w-100 pb-5">
    <div class="col-12 col-md-8 col-lg-6 mt-4">
        <div class="card border-0 bg-secondary rounded-4 p-4 shadow-sm">
            <h4 class="text-foreground fw-bold mb-4">Edit Profile</h4>
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label text-white-50">Nama Lengkap</label>
                    <input type="text" class="form-control bg-primary border-dark text-white @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="username" class="form-label text-white-50">Username</label>
                    <input type="text" class="form-control bg-primary border-dark text-white @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                    @error('username')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="email" class="form-label text-white-50">Email</label>
                    <input type="email" class="form-control bg-primary border-dark text-white @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-light bg-accent text-white border-0 rounded-pill px-4 hover-scale">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        <div class="card border-0 bg-secondary rounded-4 p-4 shadow-sm mt-4">
            <h4 class="text-foreground fw-bold mb-4">Ubah Password</h4>
            
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="current_password" class="form-label text-white-50">Password Lama</label>
                    <input type="password" class="form-control bg-primary border-dark text-white @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                    @error('current_password')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label text-white-50">Password Baru</label>
                    <input type="password" class="form-control bg-primary border-dark text-white @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label text-white-50">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control bg-primary border-dark text-white" id="password_confirmation" name="password_confirmation" required>
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-light bg-accent text-white border-0 rounded-pill px-4 hover-scale">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
