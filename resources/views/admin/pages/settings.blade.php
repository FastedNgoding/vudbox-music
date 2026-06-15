@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2 class="text-white fw-bold mb-1">Pengaturan Sistem</h2>
    <p class="text-white-50 mb-0">Konfigurasi utama aplikasi VudBox.</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 bg-secondary rounded-4 p-4 p-md-5 shadow-sm">
            <form action="" method="POST">
                @csrf
                
                <h5 class="text-white fw-bold mb-4 border-bottom border-dark border-opacity-25 pb-3">Informasi Website</h5>
                
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <label class="form-label text-white-50">Nama Website</label>
                        <input type="text" class="form-control bg-primary border-0 text-white shadow-none px-3 py-2 rounded-3" value="VudBox">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-white-50">Email Kontak</label>
                        <input type="email" class="form-control bg-primary border-0 text-white shadow-none px-3 py-2 rounded-3" value="support@vudbox.com">
                    </div>
                    <div class="col-12">
                        <label class="form-label text-white-50">Deskripsi Singkat</label>
                        <textarea class="form-control bg-primary border-0 text-white shadow-none px-3 py-2 rounded-3" rows="3">Platform streaming dan sharing musik independen terbaik.</textarea>
                    </div>
                </div>

                <h5 class="text-white fw-bold mb-4 border-bottom border-dark border-opacity-25 pb-3">Pengaturan Upload</h5>
                
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <label class="form-label text-white-50">Maksimal Ukuran File Audio (MB)</label>
                        <input type="number" class="form-control bg-primary border-0 text-white shadow-none px-3 py-2 rounded-3" value="15">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-white-50">Maksimal Ukuran Cover Art (MB)</label>
                        <input type="number" class="form-control bg-primary border-0 text-white shadow-none px-3 py-2 rounded-3" value="2">
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch d-flex align-items-center gap-3 ps-0">
                            <input class="form-check-input ms-0 mt-0 bg-primary border-0 shadow-none" type="checkbox" role="switch" id="autoApprove" checked style="width: 40px; height: 20px; cursor: pointer;">
                            <label class="form-check-label text-white fw-medium" for="autoApprove" style="cursor: pointer;">
                                Auto-Approve Lagu Baru
                                <small class="d-block text-white-50 fw-normal">Lagu langsung dipublikasi tanpa perlu review admin.</small>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end border-top border-dark border-opacity-25 pt-4">
                    <button type="submit" class="btn btn-light bg-accent border-0 text-white rounded-pill px-5 py-2 fw-bold shadow hover-scale">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- System Status Info -->
    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="card border-0 bg-secondary rounded-4 p-4 shadow-sm">
            <h5 class="text-white fw-bold mb-4">Status Sistem</h5>
            
            <ul class="list-group list-group-flush bg-transparent">
                <li class="list-group-item bg-transparent border-dark border-opacity-25 px-0 py-3 d-flex justify-content-between align-items-center">
                    <span class="text-white-50"><i class="bx bx-server me-2"></i>Versi Server</span>
                    <span class="text-white fw-medium">Ubuntu 22.04 LTS</span>
                </li>
                <li class="list-group-item bg-transparent border-dark border-opacity-25 px-0 py-3 d-flex justify-content-between align-items-center">
                    <span class="text-white-50"><i class="bx bxl-php me-2"></i>Versi PHP</span>
                    <span class="text-white fw-medium">8.2.0</span>
                </li>
                <li class="list-group-item bg-transparent border-dark border-opacity-25 px-0 py-3 d-flex justify-content-between align-items-center">
                    <span class="text-white-50"><i class="bx bxl-laravel me-2"></i>Versi Laravel</span>
                    <span class="text-white fw-medium">11.x</span>
                </li>
                <li class="list-group-item bg-transparent border-dark border-opacity-25 px-0 py-3 d-flex justify-content-between align-items-center">
                    <span class="text-white-50"><i class="bx bx-data me-2"></i>Database</span>
                    <span class="text-success fw-medium">Terhubung</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
    .form-switch .form-check-input:checked {
        background-color: var(--brand-accent) !important;
        border-color: var(--brand-accent) !important;
    }
</style>
@endsection
