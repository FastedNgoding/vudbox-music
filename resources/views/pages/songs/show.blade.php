@extends('layouts.app')

@section('title', $song->title . ' - ' . $song->artist . ' | VudBox')
@section('meta_description', 'Dengarkan lagu "' . $song->title . '" karya ' . $song->artist . ' di VudBox. Platform streaming musik independen gratis.')

@section('content')
<div class="row justify-content-center m-0 w-100 pb-5">
    <div class="col-12 col-lg-8 mt-4">
        
        <div class="card border-0 bg-secondary rounded-4 overflow-hidden shadow-sm mb-4">
            <div class="d-flex flex-column flex-md-row p-4 gap-4 align-items-center align-items-md-start">
                <div class="bg-dark rounded border border-secondary border-opacity-25 d-flex align-items-center justify-content-center text-secondary shadow-lg flex-shrink-0"
                    style="width: 200px; height: 200px; overflow: hidden; aspect-ratio: 1/1;">
                    @if ($song->cover_art_path)
                        <img src="{{ asset('storage/' . $song->cover_art_path) }}" class="img-fluid w-100 h-100 object-fit-cover" alt="Cover {{ $song->title }}">
                    @else
                        <i class="bx bx-music" style="font-size: 80px;"></i>
                    @endif
                </div>
                
                <div class="flex-grow-1 text-center text-md-start w-100">
                    <span class="badge bg-primary text-accent rounded-pill px-3 py-2 mb-2 fw-medium border border-accent">
                        {{ $song->genre ? $song->genre->name : 'Uncategorized' }}
                    </span>
                    <h2 class="text-white fw-bold mb-1 display-6">{{ $song->title }}</h2>
                    <h5 class="text-white-50 mb-3">{{ $song->artist }}</h5>
                    
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3 mt-4">
                        <button onclick="playTrack('{{ asset('storage/' . $song->audio_path) }}', '{{ addslashes($song->title) }}', '{{ addslashes($song->artist) }}', this)" 
                            data-audio-path="{{ Storage::url($song->audio_path) }}"
                            class="btn btn-light bg-accent text-white border-0 rounded-pill px-4 py-2.5 fw-bold shadow d-flex align-items-center gap-2 hover-scale">
                            <i class="bx bx-play fs-4 play-icon text-white"></i> Putar Lagu
                        </button>

                        <div class="dropdown">
                            <button class="btn btn-outline-light rounded-pill p-2 border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Tambah ke Playlist">
                                <i class="bx bx-plus fs-4"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-start bg-secondary border-0 shadow-lg mt-2 px-2 py-2" style="min-width: 220px;">
                                <li class="dropdown-header text-white-50 px-2 pb-2 border-bottom border-dark border-opacity-25 fw-semibold">Pilih Playlist</li>
                                @forelse ($playlists as $playlist)
                                    <li>
                                        <form action="{{ route('playlists.add-song', $playlist->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="song_id" value="{{ $song->id }}">
                                            <button type="submit" class="dropdown-item text-white hover-primary py-2 rounded-2 d-flex justify-content-between align-items-center bg-transparent border-0 w-100 text-start">
                                                <span class="d-flex align-items-center">
                                                    <i class="bx bx-list-music text-accent fs-5 me-2"></i>
                                                    <strong>{{ $playlist->name }}</strong>
                                                </span>
                                                <span class="badge bg-primary text-accent rounded-pill">
                                                    {{ $playlist->songs_count ?? $playlist->songs()->count() }}
                                                </span>
                                            </button>
                                        </form>
                                    </li>
                                @empty
                                    <li class="text-center py-3 text-white-50" style="font-size: 13px;">
                                        <p class="mb-2">Belum ada playlist.</p>
                                        <a href="{{ route('playlists.index') }}" class="btn btn-success btn-sm rounded-pill text-black fw-bold px-3 py-1 text-decoration-none">
                                            Buat Playlist
                                        </a>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer bg-primary bg-opacity-25 border-top border-secondary border-opacity-25 p-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-user-circle text-white-50 fs-4"></i>
                    <span class="text-white-50 small">Diunggah oleh <strong class="text-white">{{ $song->user->name }}</strong></span>
                </div>
                <span class="text-white-50 small">{{ $song->created_at->diffForHumans() }}</span>
            </div>
        </div>

        <div class="card border-0 bg-secondary rounded-4 p-4 shadow-sm">
            <h5 class="text-white fw-bold mb-4 d-flex align-items-center gap-2">
                <i class="bx bx-comment-detail text-accent"></i> Komentar ({{ $song->comments->count() }})
            </h5>
            
            <form action="{{ route('comments.store', $song->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="d-flex gap-3">
                    <div class="flex-shrink-0">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px;">
                            <i class="bx bx-user"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <textarea name="body" class="form-control bg-primary border-dark text-white rounded-3 mb-2" rows="2" placeholder="Tambahkan komentar Anda..." required></textarea>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-light bg-accent text-white border-0 rounded-pill px-4 hover-scale btn-sm fw-bold">Kirim Komentar</button>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="comments-list d-flex flex-column gap-3">
                @forelse ($song->comments as $comment)
                    <div class="d-flex gap-3 p-3 bg-primary bg-opacity-25 rounded-3 border border-secondary border-opacity-10">
                        <div class="flex-shrink-0">
                            <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center text-white-50" style="width: 40px; height: 40px;">
                                <i class="bx bx-user"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="text-white fw-semibold mb-0" style="font-size: 14px;">{{ $comment->user->name }}</h6>
                                <small class="text-white-50" style="font-size: 12px;">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="text-white-50 mb-0" style="font-size: 14px;">{{ $comment->body }}</p>
                            
                            @if(Auth::id() === $comment->user_id || (Auth::check() && Auth::user()->isAdmin()))
                            <div class="mt-2 text-end">
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0 text-decoration-none" style="font-size: 12px;" onclick="return confirm('Hapus komentar ini?')">Hapus</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <i class="bx bx-message-square-dots text-white-50 opacity-25" style="font-size: 40px;"></i>
                        <p class="text-white-50 mt-2 mb-0">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    </div>
                @endforelse
            </div>
            
        </div>
        
    </div>
</div>
@endsection
