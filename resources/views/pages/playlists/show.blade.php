@extends('layouts.app')

@section('title', $playlist->name . ' - Playlist Musik | VudBox')
@section('meta_description', 'Dengarkan playlist "' . $playlist->name . '" yang dibuat oleh ' . $playlist->user->name . ' di VudBox. Platform streaming musik independen gratis.')

@section('content')
<div class="p-4 p-md-5 mb-4 rounded-4 position-relative overflow-hidden shadow bg-linear-primary" style="border: 1px solid rgba(255,255,255,0.05);">
    <div class="row align-items-center">
        <div class="col-md-3 text-center text-md-start mb-4 mb-md-0">
            <div class="bg-primary rounded shadow-lg border border-secondary border-opacity-15 mx-auto mx-md-0 d-flex align-items-center justify-content-center text-secondary shadow" style="width: 180px; height: 180px; overflow: hidden; aspect-ratio: 1/1;">
                <i class="bx bx-list-music text-foreground opacity-75" style="font-size: 80px;"></i>
            </div>
        </div>
        <div class="col-md-9 text-center text-md-start text-white">
            <span class="badge bg-secondary text-white rounded-pill px-3 py-1.5 fw-bold mb-3">Playlist</span>
            <h1 class="display-4 fw-bold mb-1">{{ $playlist->name }}</h1>
            <p class="fs-5 text-secondary mb-3">{{ $playlist->description ?? 'Tidak ada deskripsi playlist.' }}</p>
            
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-3">
                @if($playlist->songs->isNotEmpty())
                    <button onclick='playPlaylist(@json($playlist->songs), 0, this, true)' 
                            class="btn btn-light bg-accent text-white btn-lg rounded-pill px-4 py-2.5 fw-bold border-0 shadow d-flex align-items-center gap-2 hover-scale">
                        <i class="bx bx-play fs-4 text-white play-icon"></i> Putar Semua
                    </button>
                @endif
                <a href="{{ route('playlists.index') }}" class="btn btn-outline-light rounded-pill px-4 py-2.5 fw-bold">
                    <i class="bi bi-arrow-left"></i> Kembali ke Playlist
                </a>
            </div>
            
            <div class="mt-4 pt-3 border-top border-secondary border-opacity-10">
                <small class="text-secondary d-flex align-items-center">
                    <i class="bx bx-user-circle text-success me-1 fs-5"></i> Dibuat oleh <strong class="text-white">{{ $playlist->user->name }}</strong> • Total <strong class="text-white">{{ $playlist->songs->count() }} lagu</strong>
                </small>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 rounded-4 shadow p-3 p-md-4 mb-5 bg-secondary">
    <div class="card-body p-0">
        @if($playlist->songs->isEmpty())
            <div class="d-flex text-center py-5 text-secondary flex-column align-items-center">
                <i class="bi bi-music-note-beamed text-white fs-1 mb-3 d-block opacity-50"></i>
                <p class="m-0 fs-5 text-foreground fw-bold mb-2">Playlist ini masih kosong</p>
                <p class="m-0 text-white mb-4" style="max-width: 400px; font-size: 14px; margin: 0 auto;">
                    Jelajahi lagu di beranda VudBox dan tambahkan ke playlist ini untuk mulai memutarnya!
                </p>
                <a href="{{ route('landing-page') }}" class="btn bg-foreground rounded-pill px-4 text-black fw-bold">
                    Cari Lagu Favorit Kamu
                </a>
            </div>
        @else
            <div class="list-group list-group-flush d-flex flex-column gap-2">
                @foreach($playlist->songs as $song)
                    <div class="list-group-item bg-primary bg-opacity-25 rounded-4 border border-secondary border-opacity-10 d-flex align-items-center justify-content-between p-3 transition-all hover-playlist-card"
                        style="cursor: pointer;"
                        data-audio-path="{{ Storage::url($song->audio_path) }}"
                        onclick='playPlaylist(@json($playlist->songs), {{ $loop->index }}, this, false)'>

                        <div class="d-flex align-items-center gap-3 overflow-hidden">
                            <span class="text-accent fw-bold text-center"
                                style="width: 24px; font-size: 14px;">{{ $loop->iteration }}</span>

                            <div class="bg-dark rounded border border-secondary border-opacity-25 d-flex align-items-center justify-content-center text-secondary shadow-sm overflow-hidden"
                                style="width: 44px; height: 44px; min-width: 44px;">
                                @if ($song->cover_art_path)
                                    <img src="{{ Storage::url($song->cover_art_path) }}"
                                        class="img-fluid w-100 h-100 object-fit-cover" alt="Cover">
                                @else
                                    <i class="bx bx-music fs-5"></i>
                                @endif
                            </div>

                            <div class="overflow-hidden">
                                <a href="{{ route('song.show', $song->id) }}" class="text-white text-decoration-none hover-primary text-truncate fw-semibold m-0 d-block" style="font-size: 14px;" onclick="event.stopPropagation();">
                                    {{ $song->title }}
                                </a>
                                <small class="text-accent text-truncate d-block"
                                    style="font-size: 12px;">{{ $song->artist }}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-4">
                            <span class="d-none d-md-block text-truncate text-white-50" style="font-size: 13px; max-width: 150px;">
                                {{ $song->album ?? '-' }}
                            </span>
                            
                            @if(Auth::id() === $playlist->user_id)
                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill p-1 px-3 border-0 opacity-75 hover-opacity-100" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#removeSongModal{{ $song->id }}" onclick="event.stopPropagation();">
                                <i class="bx bx-trash"></i>
                            </button>

                            <!-- Modal Remove Song -->
                            <div class="modal fade" id="removeSongModal{{ $song->id }}" tabindex="-1" aria-hidden="true" onclick="event.stopPropagation();">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content bg-secondary border border-secondary border-opacity-25 rounded-4 text-white">
                                        <div class="modal-header border-bottom border-secondary border-opacity-10">
                                            <h5 class="modal-title fw-bold">Hapus Lagu dari Playlist</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <p class="text-white-50">Apakah Anda yakin ingin menghapus <strong class="text-white">{{ $song->title }}</strong> dari playlist ini?</p>
                                        </div>
                                        <div class="modal-footer border-top border-secondary border-opacity-10">
                                            <button type="button" class="btn btn-outline-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('playlists.remove-song', [$playlist->id, $song->id]) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger rounded-pill px-4">Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="bg-accent rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 32px; height: 32px;">
                                    <i class="bx bx-play text-black fs-3 play-icon"></i>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .hover-scale {
        transition: transform 0.2s ease;
    }
    .hover-scale:hover {
        transform: scale(1.04);
    }
    .table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.04) !important;
    }
    .hover-song-row:hover .text-secondary {
        color: #ffffff !important;
    }
</style>

<!-- Modal Delete Playlist -->
<div class="modal fade" id="deletePlaylistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-secondary border border-secondary border-opacity-25 rounded-4 text-white">
            <div class="modal-header border-bottom border-secondary border-opacity-10">
                <h5 class="modal-title fw-bold">Hapus Playlist</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-white-50">Apakah Anda yakin ingin menghapus playlist <strong class="text-white">{{ $playlist->name }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer border-top border-secondary border-opacity-10">
                <button type="button" class="btn btn-outline-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('playlists.destroy', $playlist->id) }}" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
