@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center w-100 min-vh-100 pb-5 pt-4">
    <div style="width: 100%; max-width: 380px;">
        <div class="text-center mb-4">
            <h3 class="text-foreground fw-bold m-0 d-flex justify-content-center align-items-center gap-2 mb-1">
                <i class="bx bx-cloud-upload text-accent fs-2"></i> Posting Lagu
            </h3>
            <p class="text-white-50 m-0" style="font-size: 14px;">
                Buat karya baru dan bagikan
            </p>
        </div>

        <form action="{{ route('song.store') }}" method="POST" enctype="multipart/form-data" class="card bg-secondary hover-border h-100 shadow-lg border-0 overflow-hidden">
            @csrf
            
            <div class="position-relative bg-primary d-flex justify-content-center align-items-center" style="aspect-ratio: 1/1; cursor: pointer; overflow: hidden;" onclick="document.getElementById('coverInput').click()">
                <img id="coverPreview" src="" alt="" class="w-100 h-100 d-none" style="object-fit: cover;">
                <div id="coverPlaceholder" class="text-center text-white-50 position-absolute w-100 h-100 d-flex flex-column justify-content-center align-items-center hover-primary transition-bg">
                    <i class="bx bx-image-add mb-2 text-accent" style="font-size: 50px;"></i>
                    <span class="fw-semibold px-4 text-center">Klik untuk upload cover art<br><small class="fw-normal opacity-75">(Rasio 1:1, max 2MB)</small></span>
                </div>
                <input type="file" id="coverInput" name="cover" class="d-none" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event)">
            </div>

            <div class="card-body d-flex flex-column p-4">
                <div class="mb-3">
                    <input type="text" name="title" class="form-control bg-transparent border-0 border-bottom border-dark text-foreground fw-bold px-0 shadow-none fs-5 custom-input" placeholder="Judul Lagu" required>
                </div>

                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bx bx-album-covers text-white-50 fs-5"></i>
                        <input type="text" name="album" class="form-control bg-transparent border-0 border-bottom border-dark text-white-50 px-0 shadow-none custom-input" placeholder="Album" required>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bx bx-user text-white-50 fs-5"></i>
                        <input type="text" name="artist" class="form-control bg-transparent border-0 border-bottom border-dark text-white-50 px-0 shadow-none custom-input" placeholder="Nama Artis / Pencipta" required>
                    </div>
                </div>

                <select name="genre_id" class="form-select" aria-label="genres">
                    <option selected>Pilih Genre</option>
                    @foreach ($genres as $genre)
                    <option value="{{ $genre['id'] }}">{{ $genre['name'] }}</option>
                    @endforeach
                </select>

                <div class="w-100 bg-primary mb-4" style="height: 2px; opacity: 0.2;"></div>

                <div class="mb-4">
                    <label class="form-label text-white-50 fw-semibold d-flex align-items-center gap-2" style="font-size: 14px;">
                        <i class="bx bx-music text-accent"></i> File Audio
                    </label>
                    <input type="file" name="audio" class="form-control bg-primary border-0 text-white shadow-none rounded-3" accept="audio/mp3, audio/wav" required>
                    <small class="text-white-50 d-block mt-1" style="font-size: 12px;">Format: MP3/WAV, Max: 15MB</small>
                </div>

                <button type="submit" class="btn btn-light bg-accent border-0 text-white rounded-pill py-3 fw-bold shadow hover-scale w-100 mt-auto d-flex justify-content-center align-items-center gap-2">
                    <i class="bx bx-send fs-5"></i> Publikasikan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .transition-bg {
        transition: background-color 0.3s ease;
    }
    .custom-input:focus {
        border-color: var(--brand-accent) !important;
        box-shadow: none !important;
    }
    .custom-input::placeholder {
        color: rgba(255, 255, 255, 0.3) !important;
    }
    .border-dark {
        border-color: rgba(0,0,0,0.2) !important;
    }
</style>

<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        
        reader.onload = function(){
            const dataURL = reader.result;
            const preview = document.getElementById('coverPreview');
            const placeholder = document.getElementById('coverPlaceholder');
            
            preview.src = dataURL;
            preview.classList.remove('d-none');
            placeholder.classList.add('d-none');
        };
        
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
