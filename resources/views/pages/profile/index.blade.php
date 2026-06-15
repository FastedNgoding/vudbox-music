@extends('layouts.app')

@section('content')
    <div class="row justify-content-center m-0 w-100 pb-5">
        <div class="col-12 mt-4">
            <div class="card border-0 bg-secondary rounded-4 overflow-hidden shadow-sm mb-4">
                <div class="w-100 bg-linear-primary" style="height: 200px;"></div>

                <div class="card-body px-4 px-md-5 pb-5 position-relative">
                    <div class="position-absolute" style="top: -60px;">
                        <div class="rounded-circle border border-4 border-secondary overflow-hidden bg-primary d-flex justify-content-center align-items-center"
                            style="width: 120px; height: 120px;">
                            <i class="bx bx-user text-accent" style="font-size: 60px;"></i>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3 mt-md-0">
                        <a href="{{ route('profile.edit') }}"
                            class="btn btn-outline-light text-accent border-accent rounded-pill px-4 fw-bold hover-primary shadow-sm">
                            Edit Profile
                        </a>
                    </div>

                    <div class="mt-4 mt-md-2">
                        <h2 class="text-foreground fw-bold mb-1">{{ Auth::User()['name'] }}</h2>
                        <p class="text-white-50 mb-3">{{ '@' . Auth::user()['username'] }}</p>

                        <p class="text-white mb-4" style="max-width: 600px; font-size: 15px;">
                            Pecinta musik independen. Suka mengeksplorasi berbagai genre dari lo-fi, pop, hingga indie rock.
                            Selamat datang di profilku!
                        </p>

                        <div class="d-flex flex-wrap gap-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bx bx-music text-accent fs-5"></i>
                                <span class="text-white fw-semibold">{{ $uploaded->count() }}</span>
                                <span class="text-white-50">Lagu</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bx bx-list-music text-accent fs-5"></i>
                                <span class="text-white fw-semibold">0</span>
                                <span class="text-white-50">Playlist</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-pills mb-4 gap-2" id="profile-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link active bg-transparent text-foreground fw-bold px-4 rounded-pill border border-accent custom-tab-active"
                        id="tracks-tab" data-bs-toggle="pill" data-bs-target="#tracks" type="button" role="tab">Lagu
                        Saya</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link bg-transparent text-white-50 fw-bold px-4 rounded-pill border border-secondary custom-tab-inactive hover-primary"
                        id="recent-tab" data-bs-toggle="pill" data-bs-target="#recent" type="button"
                        role="tab">Aktivitas Terbaru</button>
                </li>
            </ul>

            <div class="tab-content" id="profile-tabs-content">
                <div class="tab-pane fade show active" id="tracks" role="tabpanel" tabindex="0">
                    @forelse ($uploaded as $upload)
                        <div class="list-group-item bg-secondary rounded border-opacity-10 d-flex align-items-center justify-content-between p-3 mb-2"
                            style="cursor: pointer;" data-audio-path="{{ Storage::url($upload->audio_path) }}"
                            onclick='playTrack(
                                    @json(Storage::url($upload->audio_path)),
                                    @json($upload->title),
                                    @json($upload->artist),
                                    this
                                )'>

                            <div class="d-flex align-items-center gap-3 overflow-hidden">
                                <span class="text-accent fw-bold text-center"
                                    style="width: 24px; font-size: 14px;">{{ $loop->iteration }}</span>

                                <div class="bg-dark rounded border border-secondary border-opacity-25 d-flex align-items-center justify-content-center text-secondary shadow-sm overflow-hidden"
                                    style="width: 44px; height: 44px; min-width: 44px;">
                                    @if ($upload->cover_art_path)
                                        <img src="{{ Storage::url($upload->cover_art_path) }}"
                                            class="img-fluid w-100 h-100 object-fit-cover" alt="Cover">
                                    @else
                                        <i class="bx bx-music fs-5"></i>
                                    @endif
                                </div>

                                <div class="overflow-hidden">
                                    <h6 class="text-white text-truncate fw-semibold m-0" style="font-size: 14px;">
                                        {{ $upload->title }}</h6>
                                    <small class="text-accent text-truncate d-block"
                                        style="font-size: 12px;">{{ $upload->artist }}</small>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-4">
                                <span class="d-none d-md-block text-truncate" style="font-size: 13px; max-width: 150px;">
                                    {{ $upload->album ?? '-' }}
                                </span>
                                <span class="opacity-75 d-none d-sm-inline-block" style="font-size: 12px;">
                                    <i class="bx bx-calendar-event me-1"></i>
                                    {{ $upload->created_at->diffForHumans() }}
                                </span>
                                <div class="bg-accent rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 32px; height: 32px;">
                                        <i class="bx bx-play text-black fs-3 play-icon"></i>
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="card border-0 bg-primary rounded-4 text-center p-5 shadow-sm border border-secondary">
                            <div class="card-body py-4">
                                <i class="bx bx-disc text-white-50 opacity-50 mb-3" style="font-size: 40px;"></i>
                                <h6 class="text-white-50 fw-semibold mb-0">Belum ada lagu yang diunggah.</h6>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="tab-pane fade" id="recent" role="tabpanel" tabindex="0">

                    <div class="card border-0 bg-primary rounded-4 text-center p-5 shadow-sm border border-secondary">
                        <div class="card-body py-4">
                            <i class="bx bx-time text-white-50 opacity-50 mb-3" style="font-size: 40px;"></i>
                            <h6 class="text-white-50 fw-semibold mb-0">Belum ada aktivitas terbaru.</h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .border-accent {
            border-color: var(--brand-accent) !important;
        }

        .btn-outline-light.text-accent:hover {
            background-color: var(--brand-accent) !important;
            color: var(--bs-primary) !important;
        }

        .custom-tab-active {
            background-color: var(--brand-accent) !important;
            color: var(--bs-primary) !important;
        }

        .custom-tab-inactive:hover {
            border-color: var(--brand-accent) !important;
            color: var(--brand-accent) !important;
        }
    </style>
@endsection
