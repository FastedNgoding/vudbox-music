@extends('layouts.app')

@section('content')
    <div class="w-100 pb-5">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-5">
            <div>
                <h2 class="text-foreground fw-bold m-0 d-flex align-items-center gap-2">
                    <i class="bx bx-music text-accent fs-1"></i> Playlist
                </h2>
                <p class="text-white-50 m-0 mt-1" style="font-size: 15px;">
                    Daftar putar yang kamu buat akan muncul di sini.
                </p>
            </div>
            <button
                class="btn btn-light bg-accent border-0 text-white rounded-pill px-4 py-2 fw-bold shadow hover-scale d-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#newPlaylistModal">
                <i class="bx bx-plus-circle fs-5"></i> New Playlist
            </button>
        </div>

        @if ($playlists->isEmpty())
            <div class="d-flex flex-column align-items-center justify-content-center text-center py-5"
                style="min-height: 300px;">
                <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-4"
                    style="width: 100px; height: 100px; background: rgba(148, 137, 121, 0.1);">
                    <i class="bx bx-list-music text-accent" style="font-size: 50px;"></i>
                </div>
                <h4 class="text-foreground fw-bold mb-3">Belum Ada Playlist</h4>
                <p class="text-white-50 mb-4" style="max-width: 400px; font-size: 15px;">
                    Kamu belum membuat playlist apa pun. Kelompokkan lagu-lagu favoritmu agar lebih mudah didengarkan.
                </p>
                <button class="btn btn-light bg-accent border-0 text-white rounded-pill px-4 py-2 fw-bold"
                    data-bs-toggle="modal" data-bs-target="#newPlaylistModal">
                    <i class="bx bx-plus me-2"></i> Buat Playlist Pertamamu
                </button>
            </div>
        @else
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 g-md-4">
                @foreach ($playlists as $playlist)
                    <div class="col">
                        <div class="card h-100 border-0 rounded-4 shadow bg-linear-secondary position-relative"
                            style="min-height: 180px;">
                            @if (Auth::id() === $playlist->user_id)
                                <div class="position-absolute top-0 end-0 p-3" style="z-index: 10;">
                                    <div class="dropdown">
                                        <button class="btn btn-sm text-white-50 border-0 p-0 hover-white" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            onclick="event.stopPropagation(); event.preventDefault();">
                                            <i class="bx bx-dots-vertical-rounded fs-5"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end bg-secondary border-0 shadow-lg">
                                            <li>
                                                <button class="dropdown-item text-white hover-primary py-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editPlaylistModal{{ $playlist->id }}"
                                                    onclick="event.stopPropagation(); event.preventDefault();">
                                                    <i class="bx bx-edit me-2"></i> Edit Playlist
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-danger hover-primary py-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deletePlaylistModal{{ $playlist->id }}"
                                                    onclick="event.stopPropagation(); event.preventDefault();">
                                                    <i class="bx bx-trash me-2"></i> Hapus Playlist
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <a href="{{ route('playlists.show', $playlist->id) }}"
                                class="text-decoration-none d-block h-100 p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="bg-foreground rounded-circle d-flex align-items-center justify-content-center text-black"
                                        style="width: 45px; height: 45px;">
                                        <i class="bx bx-music fs-4"></i>
                                    </div>
                                </div>

                                <h5 class="text-white fw-bold text-truncate mb-2">{{ $playlist->name }}</h5>
                                <p class="text-truncate m-0 text-accent" style="font-size: 14px;">
                                    {{ $playlist->description ?? 'Tidak ada deskripsi.' }}
                                </p>

                                <div class="mt-4 pt-3 border-top border-secondary border-opacity-10 d-flex justify-content-between align-items-center">
                                    <small class="text-white-50" style="font-size: 11px;">
                                        Dibuat {{ $playlist->created_at->format('d M Y') }}
                                    </small>
                                    <span class="badge text-accent rounded-pill"
                                        style="font-size: 11px; background: rgba(148,137,121,0.15);">
                                        {{ $playlist->songs_count }} lagu
                                    </span>
                                </div>
                            </a>
                        </div>

                        @if (Auth::id() === $playlist->user_id)
                            <div class="modal fade" id="editPlaylistModal{{ $playlist->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div
                                        class="modal-content bg-secondary border border-secondary border-opacity-25 rounded-4 text-white">
                                        <div class="modal-header border-bottom border-secondary border-opacity-10">
                                            <h5 class="modal-title fw-bold">Edit Playlist</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('playlists.update', $playlist->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body text-start">
                                                <div class="mb-3">
                                                    <label class="form-label text-white fw-medium">Nama Playlist <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="name"
                                                        class="form-control bg-dark border-secondary border-opacity-25 text-white rounded-3"
                                                        value="{{ $playlist->name }}" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label text-white fw-medium">Deskripsi <span
                                                            class="text-accent"
                                                            style="font-size: 13px;">(Opsional)</span></label>
                                                    <textarea name="description" class="form-control bg-dark border-secondary border-opacity-25 text-white rounded-3"
                                                        rows="3">{{ $playlist->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-top border-secondary border-opacity-10">
                                                <button type="button" class="btn btn-outline-light rounded-pill px-4"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit"
                                                    class="btn bg-foreground rounded-pill px-4 fw-bold text-black shadow-sm hover-scale">Simpan
                                                    Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deletePlaylistModal{{ $playlist->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div
                                        class="modal-content bg-secondary border border-secondary border-opacity-25 rounded-4 text-white">
                                        <div class="modal-header border-bottom border-secondary border-opacity-10">
                                            <h5 class="modal-title fw-bold">Hapus Playlist</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-white-50 mb-0">Hapus playlist <strong
                                                    class="text-white">{{ $playlist->name }}</strong>? Tindakan ini tidak
                                                dapat dibatalkan.</p>
                                        </div>
                                        <div class="modal-footer border-top border-secondary border-opacity-10">
                                            <button type="button" class="btn btn-outline-light rounded-pill px-4"
                                                data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('playlists.destroy', $playlist->id) }}" method="POST"
                                                class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger rounded-pill px-4">Ya,
                                                    Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="modal fade" id="newPlaylistModal" tabindex="-1" aria-labelledby="NewPlaylistLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title text-foreground" id="NewPlaylistLabel">New Playlist</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('playlists.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="playlistName" class="form-label text-white fw-medium">Nama Playlist <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="name"
                                class="form-control bg-dark border-secondary border-opacity-25 text-white rounded-3"
                                id="playlistName" placeholder="Contoh: Lagu Santai Sore" required>
                        </div>
                        <div class="mb-2">
                            <label for="playlistDesc" class="form-label text-white fw-medium">Deskripsi <span
                                    class="text-accent" style="font-size: 13px;">(Opsional)</span></label>
                            <textarea name="description" class="form-control bg-dark border-secondary border-opacity-25 text-white rounded-3"
                                id="playlistDesc" rows="3" placeholder="Contoh: Kumpulan lagu indie syahdu."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary border-opacity-10">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-3"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn bg-foreground rounded-pill px-4 fw-bold text-black shadow-sm hover-scale">Buat
                            Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
