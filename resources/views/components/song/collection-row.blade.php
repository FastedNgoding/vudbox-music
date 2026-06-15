@props(['song', 'genres', 'iteration'])
<div class="list-group-item bg-transparent border-0 d-flex align-items-center justify-content-between p-3 border-bottom border-dark">
    <div class="d-flex align-items-center gap-3 overflow-hidden">
        <span class="text-white-50 fw-bold text-center" style="width: 24px; font-size: 14px;">{{ $iteration }}</span>
        
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center text-white-50 shadow-sm overflow-hidden" 
             style="width: 50px; height: 50px; min-width: 50px;">
            @if($song->cover_art_path)
                <img src="{{ Storage::url($song->cover_art_path) }}" class="img-fluid w-100 h-100 object-fit-cover" alt="Cover">
            @else
                <i class="bx bx-music fs-4"></i>
            @endif
        </div>

        <div class="overflow-hidden">
            <a href="{{ route('song.show', $song->id) }}" class="text-foreground text-truncate fw-semibold m-0 mb-1 text-decoration-none hover-primary d-block" style="font-size: 15px;">{{ $song->title }}</a>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('song.show', $song->id) }}" class="text-white-50 text-truncate text-decoration-none hover-primary" style="font-size: 13px;">{{ $song->artist }}</a>
                @if($song->genre)
                    <span class="badge bg-primary text-accent rounded-pill px-2 py-0.5" style="font-size: 10px;">{{ $song->genre->name }}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center gap-3">
        <span class="text-white-50 d-none d-md-block text-truncate" style="font-size: 13px; max-width: 150px;">
            {{ $song->album ?? 'Single' }}
        </span>
        <span class="text-white-50 opacity-75 d-none d-sm-inline-block" style="font-size: 12px;">
            <i class="bx bx-time-five me-1"></i> {{ $song->created_at->diffForHumans() }}
        </span>
        
        <div class="d-flex gap-2">
            <button onclick="playTrack('{{ Storage::url($song->audio_path) }}', '{{ addslashes($song->title) }}', '{{ addslashes($song->artist) }}', this)" 
                    data-audio-path="{{ Storage::url($song->audio_path) }}"
                    class="btn btn-sm btn-light bg-accent border-0 rounded-circle d-flex align-items-center justify-content-center shadow hover-scale" 
                    style="width: 35px; height: 35px;"
                    title="Putar Lagu">
                <i class="bx bx-play play-icon text-white fs-4 ms-1"></i>
            </button>
            
            <button class="btn btn-sm btn-outline-light border-0 rounded-circle d-flex align-items-center justify-content-center hover-scale" 
                    style="width: 35px; height: 35px;" 
                    data-bs-toggle="modal" 
                    data-bs-target="#editSongModal{{ $song->id }}"
                    title="Edit Lagu">
                <i class="bx bx-edit text-info fs-5"></i>
            </button>
            
            <button class="btn btn-sm btn-outline-light border-0 rounded-circle d-flex align-items-center justify-content-center hover-scale" 
                    style="width: 35px; height: 35px;" 
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteSongModal{{ $song->id }}"
                    title="Hapus Lagu">
                <i class="bx bx-trash text-danger fs-5"></i>
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="editSongModal{{ $song->id }}" tabindex="-1" aria-labelledby="editSongModalLabel{{ $song->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-secondary text-white border-0 rounded-4 shadow-lg">
            <div class="modal-header border-bottom border-secondary border-opacity-10 px-4">
                <h5 class="modal-title fw-bold" id="editSongModalLabel{{ $song->id }}">
                    <i class="bx bx-edit text-accent me-2"></i> Edit Lagu
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('song.update', $song->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body px-4 py-3">
                    <div class="d-flex flex-column align-items-center mb-4">
                        <div class="position-relative bg-primary d-flex justify-content-center align-items-center rounded-3 overflow-hidden shadow-sm" 
                             style="width: 120px; height: 120px; cursor: pointer;" 
                             onclick="document.getElementById('coverInput{{ $song->id }}').click()">
                            @if($song->cover_art_path)
                                <img id="coverPreview{{ $song->id }}" src="{{ Storage::url($song->cover_art_path) }}" class="w-100 h-100 object-fit-cover" alt="Cover">
                            @else
                                <img id="coverPreview{{ $song->id }}" src="" class="w-100 h-100 object-fit-cover d-none" alt="Cover">
                                <i id="coverPlaceholderIcon{{ $song->id }}" class="bx bx-image-add text-accent" style="font-size: 40px;"></i>
                            @endif
                        </div>
                        <input type="file" id="coverInput{{ $song->id }}" name="cover" class="d-none cover-input-file" data-preview-id="coverPreview{{ $song->id }}" data-placeholder-id="coverPlaceholderIcon{{ $song->id }}" accept="image/png, image/jpeg, image/jpg, image/webp">
                        <small class="text-white-50 mt-2">Klik gambar untuk mengubah Cover Art</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white-50 small mb-1">Judul Lagu</label>
                        <input type="text" name="title" value="{{ $song->title }}" class="form-control bg-transparent border-0 border-bottom border-dark text-white px-0 shadow-none custom-input fw-bold" placeholder="Judul Lagu" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white-50 small mb-1">Nama Artis / Pencipta</label>
                        <input type="text" name="artist" value="{{ $song->artist }}" class="form-control bg-transparent border-0 border-bottom border-dark text-white px-0 shadow-none custom-input" placeholder="Nama Artis" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white-50 small mb-1">Album</label>
                        <input type="text" name="album" value="{{ $song->album }}" class="form-control bg-transparent border-0 border-bottom border-dark text-white px-0 shadow-none custom-input" placeholder="Album (Opsional)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white-50 small mb-1">Genre</label>
                        <select name="genre_id" class="form-select bg-primary border-0 text-white rounded-3 shadow-none">
                            <option value="">Pilih Genre</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ $song->genre_id == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white-50 small mb-1">Ganti File Audio (Opsional)</label>
                        <input type="file" name="audio" class="form-control bg-primary border-0 text-white shadow-none rounded-3" accept="audio/mp3, audio/wav, audio/ogg, audio/m4a, audio/flac">
                        <small class="text-white-50 d-block mt-1" style="font-size: 11px;">Format: MP3/WAV/OGG/M4A/FLAC, Max: 20MB</small>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary border-opacity-10 px-4 py-3">
                    <button type="button" class="btn btn-outline-light rounded-pill px-3 py-1.5" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-light bg-accent border-0 text-white rounded-pill px-4 py-1.5 fw-bold shadow hover-scale">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteSongModal{{ $song->id }}" tabindex="-1" aria-labelledby="deleteSongModalLabel{{ $song->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-secondary text-white border-0 rounded-4 shadow-lg">
            <div class="modal-header border-bottom border-secondary border-opacity-10 px-4">
                <h5 class="modal-title fw-bold" id="deleteSongModalLabel{{ $song->id }}">
                    <i class="bx bx-trash text-danger me-2"></i> Hapus Lagu
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-4 text-center">
                <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-3" style="width: 70px; height: 70px; background: rgba(220, 53, 69, 0.1);">
                    <i class="bx bx-alert-triangle text-danger" style="font-size: 35px;"></i>
                </div>
                <h5 class="fw-bold mb-2">Apakah kamu yakin?</h5>
                <p class="text-white-50 mb-0 px-3" style="font-size: 14px;">
                    Lagu <strong class="text-white">"{{ $song->title }}"</strong> akan dihapus permanen dari VudBox. Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer border-top border-secondary border-opacity-10 px-4 py-3">
                <button type="button" class="btn btn-outline-light rounded-pill px-3 py-1.5" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('song.destroy', $song->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4 py-1.5 fw-bold shadow hover-scale">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
