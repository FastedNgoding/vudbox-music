@extends('layouts.app')

@section('title', 'Beranda - VudBox | Platform Streaming & Sharing Musik Independen')
@section('meta_description', 'Eksplorasi musik independen dari berbagai kreator, unggah karya orisinalmu, atau dengarkan lagu-lagu hits buatan orang lain secara gratis di VudBox.')

@section('content')
    <style>
        .cover-wrapper {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .cover-img {
            transition: 0.25s ease;
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(2px);
            opacity: 0;
            transition: 0.25s ease;
            z-index: 2;
        }

        .cover-wrapper:hover .overlay {
            opacity: 1;
        }

        .cover-wrapper:hover .cover-img {
            transform: scale(1.05);
        }
    </style>
    <div
        class="p-4 p-md-5 mb-4 rounded-4 position-relative overflow-hidden bg-success-subtle bg-gradient shadow bg-linear-primary">
        <div class="row align-items-center position-relative" style="z-index: 2;">
            <div class="col-md-8 text-white">
                <span class="badge bg-black bg-opacity-25 text-white rounded-pill px-3 py-2 mb-3">Selamat
                    Datang di
                    VudBox</span>
                <h1 class="display-5 fw-bold mb-2">Halo, {{ Str::limit(Auth::user()['name'], 13) }}</h1>
                <p class="lead opacity-75 mb-4" style="font-size: 16px;">
                    Eksplorasi musik independen dari berbagai kreator, unggah karya orisinalmu, atau
                    dengarkan
                    lagu-lagu hits buatan orang lain secara gratis.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ url('posting') }}"
                        class="btn btn-light rounded-pill px-4 py-2 fw-bold text-black border-0 shadow-sm transition-transform hover-scale">
                        <i class="bx bx-plus-circle me-2"></i> Mulai Posting Lagu
                    </a>
                    <a href="#explore"
                        class="btn btn-outline-light rounded-pill px-4 py-2 fw-bold transition-transform hover-scale">
                        <i class="bx bx-search me-2"></i> Cari Musik
                    </a>
                </div>
            </div>
            <div class="col-md-4 d-none d-md-flex justify-content-center text-white opacity-25">
                <i class="bi bi-disc-fill" style="font-size: 180px; animation: spin 20s linear infinite;"></i>
            </div>
        </div>
    </div>

    <div id="explore" class="row row-cols-2 row-cols-sm-3 row-cols-xl-4 g-3 w-100 m-0 pb-4">
        @forelse ($data as $d)
            <x-song.card :song="$d" />
        @empty
            <div class="col-12 text-center py-5 text-secondary w-100">
                <i class="bx bx-music fs-1 mb-3 opacity-50 text-accent"></i>
                <h5 class="text-white fw-bold">Musik Tidak Ditemukan</h5>
                <p class="text-white-50" style="font-size: 14px;">Tidak ada lagu yang cocok dengan pencarian Anda.</p>
            </div>
        @endforelse
    </div>

    <x-modals.add-to-playlist :playlists="$playlists" />
@endsection
