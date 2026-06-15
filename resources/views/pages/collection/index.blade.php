@extends('layouts.app')

@section('title', 'Koleksi Musik Saya - VudBox')
@section('meta_description', 'Kelola, edit, dan hapus karya musik orisinal Anda yang telah dipublikasikan di platform VudBox.')

@section('content')
<div class="row justify-content-center m-0 w-100">
    <div class="mt-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-5">
            <div>
                <h2 class="text-foreground fw-bold m-0 d-flex align-items-center gap-2">
                    <i class="bx bx-bookmarks text-accent fs-1"></i> Koleksi Saya
                </h2>
                <p class="text-white-50 m-0 mt-1" style="font-size: 15px;">
                    Kumpulan seluruh karya musik yang telah kamu simpan dan publikasikan di VudBox.
                </p>
            </div>
        </div>

        @if($songs->isEmpty())
            <div class="card border-0 bg-secondary rounded-4 text-center shadow-sm hover-shadow">
                <div class="card-body py-5">
                    <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-4" style="width: 100px; height: 100px; background: rgba(148, 137, 121, 0.1);">
                        <i class="bx bx-music text-accent" style="font-size: 50px;"></i>
                    </div>
                    <h4 class="text-foreground fw-bold mb-3">Kamu Belum Memiliki Koleksi</h4>
                    <p class="text-white-50 mx-auto mb-4" style="max-width: 450px; font-size: 15px;">
                        Lagu-lagu yang kamu unggah atau simpan akan muncul di sini. Ayo mulai perjalanan musikmu dan bagikan karya terbaikmu sekarang juga!
                    </p>
                    <a href="{{ url('posting') }}" class="btn btn-outline-light text-accent border-accent rounded-pill px-4 py-2 fw-bold hover-primary">
                        <i class="bx bx-cloud-upload me-2"></i> Unggah Lagu Pertama
                    </a>
                </div>
            </div>
        @else
            <div class="card border-0 bg-secondary rounded-4 overflow-hidden shadow-sm">
                <div class="list-group list-group-flush">
                    @foreach($songs as $song)
                        <x-song.collection-row :song="$song" :genres="$genres" :iteration="$loop->iteration" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.cover-input-file').forEach(input => {
            input.addEventListener('change', function(e) {
                const previewId = this.dataset.previewId;
                const placeholderId = this.dataset.placeholderId;
                const previewImg = document.getElementById(previewId);
                const placeholderIcon = document.getElementById(placeholderId);
                
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (previewImg) {
                            previewImg.src = e.target.result;
                            previewImg.classList.remove('d-none');
                        }
                        if (placeholderIcon) {
                            placeholderIcon.classList.add('d-none');
                        }
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    });
</script>
@endsection
