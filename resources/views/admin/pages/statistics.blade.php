@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2 class="text-white fw-bold mb-1">Statistik Platform</h2>
    <p class="text-white-50 mb-0">Laporan mendalam mengenai performa aplikasi.</p>
</div>

<div class="row g-4 mb-4">
    <!-- Chart Placeholder 1 -->
    <div class="col-lg-8">
        <div class="card border-0 bg-secondary rounded-4 p-4 shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="text-white fw-bold mb-0">Pertumbuhan Pengguna & Lagu</h5>
                <select class="form-select bg-primary border-0 text-white shadow-none w-auto rounded-pill px-3 py-1" style="font-size: 14px;">
                    <option>Tahun Ini</option>
                    <option>Bulan Ini</option>
                    <option>Minggu Ini</option>
                </select>
            </div>
            
            <div class="bg-primary rounded-4 w-100 d-flex justify-content-center align-items-center position-relative" style="height: 300px; overflow: hidden;">
                <!-- Abstract chart representation -->
                <div class="w-100 h-100 d-flex align-items-end px-3 gap-2 pb-3 opacity-50">
                    <div class="bg-accent rounded-top w-100" style="height: 20%; transition: 1s;"></div>
                    <div class="bg-accent rounded-top w-100" style="height: 35%; transition: 1s;"></div>
                    <div class="bg-accent rounded-top w-100" style="height: 25%; transition: 1s;"></div>
                    <div class="bg-accent rounded-top w-100" style="height: 50%; transition: 1s;"></div>
                    <div class="bg-accent rounded-top w-100" style="height: 40%; transition: 1s;"></div>
                    <div class="bg-accent rounded-top w-100" style="height: 70%; transition: 1s;"></div>
                    <div class="bg-accent rounded-top w-100" style="height: 60%; transition: 1s;"></div>
                    <div class="bg-accent rounded-top w-100" style="height: 90%; transition: 1s;"></div>
                </div>
                <div class="position-absolute text-white-50 fw-semibold bg-secondary px-4 py-2 rounded-pill shadow-sm">
                    <i class="bx bx-bar-chart-alt-2 text-accent me-2"></i> Grafik Interaktif (Membutuhkan JS Library)
                </div>
            </div>
        </div>
    </div>
    
    <!-- Top Genres -->
    <div class="col-lg-4">
        <div class="card border-0 bg-secondary rounded-4 p-4 shadow-sm h-100">
            <h5 class="text-white fw-bold mb-4">Top Genre</h5>
            
            <div class="d-flex flex-column gap-4">
                <div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white fw-medium">Pop</span>
                        <span class="text-accent fw-bold">45%</span>
                    </div>
                    <div class="progress bg-primary" style="height: 10px;">
                        <div class="progress-bar bg-accent rounded-pill" role="progressbar" style="width: 45%"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white fw-medium">Indie</span>
                        <span class="text-white-50 fw-bold">25%</span>
                    </div>
                    <div class="progress bg-primary" style="height: 10px;">
                        <div class="progress-bar bg-light rounded-pill" style="width: 25%"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white fw-medium">Hip Hop</span>
                        <span class="text-white-50 fw-bold">15%</span>
                    </div>
                    <div class="progress bg-primary" style="height: 10px;">
                        <div class="progress-bar bg-secondary border border-light rounded-pill" style="width: 15%"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white fw-medium">Rock</span>
                        <span class="text-white-50 fw-bold">10%</span>
                    </div>
                    <div class="progress bg-primary" style="height: 10px;">
                        <div class="progress-bar bg-dark rounded-pill" style="width: 10%"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white fw-medium">Lainnya</span>
                        <span class="text-white-50 fw-bold">5%</span>
                    </div>
                    <div class="progress bg-primary" style="height: 10px;">
                        <div class="progress-bar bg-dark opacity-50 rounded-pill" style="width: 5%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
