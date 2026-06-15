<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', 'VudBox - Platform Streaming & Sharing Musik Independen')</title>
    <meta name="description" content="@yield('meta_description', 'VudBox adalah platform streaming dan berbagi musik independen terbaik. Dengarkan, unggah, dan bagikan karya musik orisinalmu secara gratis.')">
    <meta name="keywords" content="vudbox, musik, streaming musik, musik independen, unggah lagu, mp3 gratis, lagu indie">
    <meta name="author" content="VudBox Team">
    <meta name="robots" content="index, follow">
    
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'VudBox - Platform Streaming & Sharing Musik Independen')">
    <meta property="og:description" content="@yield('meta_description', 'VudBox adalah platform streaming dan berbagi musik independen terbaik. Dengarkan, unggah, dan bagikan karya musik orisinalmu secara gratis.')">
    <meta property="og:image" content="{{ url('logo.png') }}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'VudBox - Platform Streaming & Sharing Musik Independen')">
    <meta property="twitter:description" content="@yield('meta_description', 'VudBox adalah platform streaming dan berbagi musik independen terbaik. Dengarkan, unggah, dan bagikan karya musik orisinalmu secara gratis.')">
    <meta property="twitter:image" content="{{ url('logo.png') }}">

    <link rel="shortcut icon" href="{{ url('logo.png') }}" type="image/x-icon">
    @vite('resources/js/app.js')
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
</head>

<body class="bg-primary">
    <header>
        <x-app.navbar />
    </header>
    <main class="text-foreground">
        @if (session('success'))
            <div class="alert bg-success text-white alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow border-0"
                style="z-index: 9999; min-width: 300px;" role="alert">
                <i class="bx bx-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert bg-danger text-white alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow border-0"
                style="z-index: 9999; min-width: 300px;" role="alert">
                <i class="bx bx-error-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert bg-danger text-white alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow border-0"
                style="z-index: 9999; min-width: 300px;" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex flex-column flex-lg-row px-3 px-lg-5 gap-4" style="height: calc(100vh - 90px);">
            <x-app.sidebar />

            <div class="flex-grow-1 overflow-y-auto scroll-hidden w-100 pb-5 pb-lg-0" style="height:100%;">
                @yield('content')

                <div class="py-4 d-block d-lg-none"></div>
            </div>
        </div>

        <x-app.mobile-nav />
    </main>
    <audio id="vudbox-audio" style="display:none;"></audio>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const audio = document.getElementById('vudbox-audio');
            if (!audio) return;

            let playlist = [];
            let index = -1;

            const resetIcons = () => {
                document.querySelectorAll('.play-icon').forEach(i => {
                    i.classList.remove('bx-pause');
                    i.classList.add('bx-play');
                });
            };

            const setCurrentIcon = (playing = true) => {
                resetIcons();

                if (!playing) return;

                const currentUrl = audio.src;
                document.querySelectorAll('[data-audio-path]').forEach(el => {
                    const path = el.getAttribute('data-audio-path');
                    if (path && (currentUrl.includes(path) || path.includes(currentUrl.replace(window.location.origin, '')))) {
                        const icon = el.querySelector('.play-icon') || (el.classList.contains('play-icon') ? el : null);
                        if (icon) {
                            icon.classList.remove('bx-play');
                            icon.classList.add('bx-pause');
                        }
                    }
                });

                if (playlist.length > 0) {
                    const playAllBtn = document.querySelector('button[onclick*="playPlaylist"]');
                    if (playAllBtn) {
                        const allIcon = playAllBtn.querySelector('.play-icon');
                        if (allIcon) {
                            allIcon.classList.remove('bx-play');
                            allIcon.classList.add('bx-pause');
                        }
                    }
                }
            };

            const playSong = url => {
                audio.src = url;
                audio.play();
                setCurrentIcon(true);
            };

            window.playTrack = (url) => {
                const sameSong = audio.src && (audio.src.includes(url) || url.includes(audio.src.replace(window.location.origin, '')));
                
                if (sameSong) {
                    if (audio.paused) {
                        audio.play();
                        setCurrentIcon(true);
                    } else {
                        audio.pause();
                        setCurrentIcon(false);
                    }
                    return;
                }

                playlist = [];
                index = -1;
                playSong(url);
            };

            window.playPlaylist = (songs, start = 0, el = null, isPlayAll = false) => {
                if (!songs?.length) return;

                const isSamePlaylist = playlist.length === songs.length && 
                                       playlist.length > 0 && 
                                       playlist[0].id === songs[0].id;

                if (isSamePlaylist) {
                    const isSameTrack = isPlayAll || index === start;
                    if (isSameTrack) {
                        if (audio.paused) {
                            audio.play();
                            setCurrentIcon(true);
                        } else {
                            audio.pause();
                            setCurrentIcon(false);
                        }
                        return;
                    }
                }

                playlist = songs;
                index = start;
                playSong('/storage/' + songs[start].audio_path);
            };

            const detik = document.getElementById('detik');

            audio.addEventListener('timeupdate', () => {
                if (detik) detik.textContent = Math.floor(audio.currentTime);
            });

            audio.addEventListener('ended', () => {
                if (playlist.length && index < playlist.length - 1) {
                    index++;
                    playSong('/storage/' + playlist[index].audio_path);
                    return;
                }

                playlist = [];
                index = -1;
                resetIcons();
            });
        });
    </script>
</body>

</html>
