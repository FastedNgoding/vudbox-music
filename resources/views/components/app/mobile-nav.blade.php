<div class="w-100 d-flex d-lg-none justify-content-center fixed-bottom pb-3 z-3">
    <div class="bg-secondary rounded-pill shadow-lg px-4 py-2" style="width: 90%; max-width: 400px;">
        <ul class="d-flex justify-content-between align-items-center list-unstyled mb-0 ps-0 w-100">
            <li>
                <a href="{{ url('') }}"
                    class="text-white d-flex flex-column align-items-center text-decoration-none py-1">
                    <i class="bx bx-home fs-2"></i>
                    <small style="font-size: 0.65rem;">Beranda</small>
                </a>
            </li>

            <li>
                <a href="{{ route('collection') }}"
                    class="text-white-50 d-flex flex-column align-items-center text-decoration-none py-1">
                    <i class="bx bx-bookmarks fs-2"></i>
                    <small style="font-size: 0.65rem;">Koleksi</small>
                </a>
            </li>

            <li>
                <a href="{{ url('posting') }}"
                    class="text-white-50 d-flex flex-column align-items-center text-decoration-none py-1"
                    style="border-radius: 50%;">
                    <i class="bx bx-plus-circle text-accent" style="font-size: 45px;"></i>
                </a>
            </li>

            <li>
                <a href="{{ url('playlists') }}"
                    class="text-white-50 d-flex flex-column align-items-center text-decoration-none py-1">
                    <i class="bx bx-music fs-2"></i>
                    <small style="font-size: 0.65rem;">Playlist</small>
                </a>
            </li>

            <li>
                <a href="{{ url('profile') }}"
                    class="text-white-50 d-flex flex-column align-items-center text-decoration-none py-1">
                    <i class="bx bx-user fs-2"></i>
                    <small style="font-size: 0.65rem;">Profile</small>
                </a>
            </li>
        </ul>
    </div>
</div>
