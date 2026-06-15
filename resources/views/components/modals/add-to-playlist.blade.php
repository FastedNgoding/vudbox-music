@props(['playlists'])
<div class="modal fade hide" id="addToPlaylistModal" tabindex="-1" aria-labelledby="addToPlaylistModalLabel"
    aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-secondary border border-secondary border-opacity-25 rounded-4 text-white">
            <div class="modal-header border-bottom border-secondary border-opacity-10">
                <h5 class="modal-title fw-bold" id="addToPlaylistModalLabel">Tambah ke Playlist</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-white fs-7 mb-3">Pilih playlist untuk lagu <strong class="text-foreground"
                        id="modal-song-title"></strong>:</p>

                <form id="playlistForm" method="POST">
                    @csrf
                    <input type="hidden" name="song_id" id="modal-song-id">

                    <div
                        class="list-group list-group-flush rounded-3 overflow-hidden border border-secondary border-opacity-10">
                        @forelse ($playlists as $playlist)
                            <button type="button"
                                class="list-group-item list-group-item-action bg-primary text-white border-bottom border-secondary border-opacity-10 d-flex justify-content-between align-items-center px-3 py-2.5 hover-bg-dark-subtle"
                                onclick="submitToPlaylist({{ $playlist->id }})">
                                <span class="d-flex align-items-center">
                                    <i class="bx bx-list-music text-foreground fs-5 me-2"></i>
                                    <strong>{{ $playlist->name }}</strong>
                                </span>
                                <span class="badge bg-secondary bg-opacity-25 text-accent rounded-pill">
                                    {{ $playlist->songs_count ?? $playlist->songs()->count() }} lagu
                                </span>
                            </button>
                        @empty
                            <div class="text-center py-4">
                                <i class="bi bi-music-note-list text-secondary fs-1 mb-3 d-block"></i>
                                <p class="text-secondary fs-7 mb-3">Kamu belum memiliki playlist.</p>
                                <a href="{{ route('playlists.index') }}"
                                    class="btn btn-success btn-sm rounded-pill text-black fw-bold px-3">
                                    Buat Playlist Pertama Kamu
                                </a>
                            </div>
                        @endforelse
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addToPlaylistModal = document.getElementById('addToPlaylistModal');
        if (addToPlaylistModal) {
            addToPlaylistModal.addEventListener('show.bs.modal', (event) => {
                const button = event.relatedTarget;
                const songId = button.getAttribute('data-song-id');
                const songTitle = button.getAttribute('data-song-title');

                document.getElementById('modal-song-title').innerText = songTitle;
                document.getElementById('modal-song-id').value = songId;
            });
        }
    });

    function submitToPlaylist(playlistId) {
        const form = document.getElementById('playlistForm');
        form.action = `/playlists/${playlistId}/songs`;
        form.submit();
    }
</script>
