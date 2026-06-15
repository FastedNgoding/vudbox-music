@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-white fw-bold mb-1">Dashboard</h2>
            <p class="text-white-50 mb-0">Ringkasan aktivitas platform hari ini.</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-sm-4">
            <div
                class="card border-0 bg-secondary rounded-4 p-4 shadow-sm h-100 hover-shadow position-relative overflow-hidden">
                <div class="position-absolute" style="right: -15px; bottom: -15px; opacity: 0.05;">
                    <i class="bx bx-music" style="font-size: 120px;"></i>
                </div>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center p-3 text-accent">
                        <i class="bx bx-music fs-3"></i>
                    </div>
                    <h6 class="text-white-50 mb-0 fw-semibold">Total Lagu</h6>
                </div>
                <h3 class="text-white fw-bold mb-2">{{ number_format($stats['total_songs']) }}</h3>
            </div>
        </div>

        <div class="col-sm-4">
            <div
                class="card border-0 bg-secondary rounded-4 p-4 shadow-sm h-100 hover-shadow position-relative overflow-hidden">
                <div class="position-absolute" style="right: -15px; bottom: -15px; opacity: 0.05;">
                    <i class="bx bx-user" style="font-size: 120px;"></i>
                </div>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center p-3 text-accent">
                        <i class="bx bx-user fs-3"></i>
                    </div>
                    <h6 class="text-white-50 mb-0 fw-semibold">Pengguna</h6>
                </div>
                <h3 class="text-white fw-bold mb-2">{{ number_format($stats['total_users']) }}</h3>
            </div>
        </div>

        <div class="col-sm-4">
            <div
                class="card border-0 bg-secondary rounded-4 p-4 shadow-sm h-100 hover-shadow position-relative overflow-hidden">
                <div class="position-absolute" style="right: -15px; bottom: -15px; opacity: 0.05;">
                    <i class="bx bx-category" style="font-size: 120px;"></i>
                </div>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center p-3 text-accent">
                        <i class="bx bx-boombox fs-3"></i>
                    </div>
                    <h6 class="text-white-50 mb-0 fw-semibold">Total Genre</h6>
                </div>
                <h3 class="text-white fw-bold mb-2">{{ number_format($stats['total_genres']) }}</h3>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 bg-secondary rounded-4 p-4 shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="text-white fw-bold mb-0">Lagu Terbaru</h5>
                    <a href="{{ route('admin.songs') }}" class="text-accent text-decoration-none"
                        style="font-size: 14px;">Lihat Semua</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-dark table-hover table-borderless align-middle mb-0">
            <thead class="text-white-50 border-bottom border-dark border-opacity-25">
                            <tr>
                                <th class="fw-medium pb-3 ps-3">Judul Lagu</th>
                                <th class="fw-medium pb-3">Artis</th>
                                <th class="fw-medium pb-3">Tanggal</th>
                                <th class="fw-medium pb-3">Genre</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse($recent_songs as $song)
                                <tr>
                                    <td
                                        class="ps-3 py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-primary rounded text-accent d-flex align-items-center justify-content-center overflow-hidden"
                                                style="width: 40px; height: 40px;">
                                                @if ($song->cover_art_path)
                                                    <img src="{{ Storage::url($song->cover_art_path) }}" alt="Cover"
                                                        class="img-fluid w-100 h-100 object-fit-cover">
                                                @else
                                                    <i class="bx bx-music"></i>
                                                @endif
                                            </div>
                                            <span class="text-white fw-semibold">{{ $song->title }}</span>
                                        </div>
                                    </td>
                                    <td
                                        class="text-white-50 py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                                        {{ $song->artist }}</td>
                                    <td
                                        class="text-white-50 py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                                        {{ $song->created_at->format('d M Y') }}</td>
                                    <td class="py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                                        <span
                                            class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">{{ $song->genre->name ?? '-' }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-white-50 py-4">Belum ada lagu.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table-hover tbody tr:hover {
            background-color: var(--bs-primary) !important;
            color: white;
        }

        .table-hover tbody tr:hover td {
            color: white !important;
        }
    </style>
@endsection
