@props(['song'])
<div class="col">
    <div class="card bg-secondary hover-border h-100">
        <div class="cover-wrapper" data-audio-path="{{ Storage::url($song->audio_path) }}"
            onclick='playTrack(@json(Storage::url($song->audio_path)), @json($song->title), @json($song->artist), this)'>

            <img src="{{ Storage::url($song->cover_art_path) }}" class="w-100"
                style="aspect-ratio: 1/1; object-fit: cover;">

            <div class="overlay d-flex align-items-center justify-content-center">
                <i class="bx bx-play play-icon fs-1 text-white"></i>
            </div>
        </div>
        <div class="card-body d-flex flex-column p-2">
            <div class="d-flex justify-content-between align-items-center gap-1 mb-2">
                <div class="d-flex flex-column min-w-0 flex-grow-1">
                    <a href="{{ route('song.show', $song->id) }}" class="card-text text-foreground fw-bold text-decoration-none hover-primary"
                        style="font-size: 0.9rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; word-break: break-word;">{{ $song->title }}</a>
                    <a href="{{ route('song.show', $song->id) }}" class="card-text text-truncate text-white-50 text-decoration-none hover-primary"
                        style="font-size: .75rem;">{{ $song->artist }}</a>
                </div>
                <button class="btn btn-link text-secondary p-0 border-0 fs-5 hover-white" type="button"
                    data-bs-toggle="modal" data-bs-target="#addToPlaylistModal"
                    data-song-id="{{ $song->id }}" data-song-title="{{ $song->title }}">
                    <i class="bx bx-plus-circle fs-4 text-foreground"></i>
                </button>
            </div>
            <div class="w-100 bg-primary mt-auto mb-2" style="height: 2px; opacity: 0.2;"></div>
            <a href="{{ route('song.show', $song->id) }}" class="d-flex align-items-center gap-1 text-truncate text-decoration-none hover-primary">
                <i class="bx bx-user text-foreground flex-shrink-0" style="font-size: 0.8rem;"></i>
                <small class="text-truncate text-white-50" style="font-size: .7rem;"
                    title="{{ $song->user->name }}">{{ $song->user->name }}</small>
            </a>
        </div>
    </div>
</div>
