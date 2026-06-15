<div class="d-none d-lg-block bg-secondary rounded-4 shadow-sm p-3" style="width:250px; flex-shrink: 0;">
    <h6 class="text-white fw-bold mb-3 px-2">
        Menu
    </h6>
    <ul class="nav flex-column gap-2">
        <li class="nav-item">
            <a href="{{ route('landing-page') }}" class="nav-link text-white rounded-3 px-3 py-2 d-flex align-items-center gap-3 {{ request()->is('/') ? 'active bg-primary bg-opacity-50 border-start border-3 border-accent' : 'text-white-50 hover-primary' }}">
                <i class="bx bx-home fs-5 {{ request()->is('/') ? 'text-accent' : '' }}"></i>
                <span>Beranda</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('collection') }}" class="nav-link text-white rounded-3 px-3 py-2 d-flex align-items-center gap-3 {{ request()->is('collection') ? 'active bg-primary bg-opacity-50 border-start border-3 border-accent' : 'text-white-50 hover-primary' }}">
                <i class="bx bx-bookmarks fs-5 {{ request()->is('collection') ? 'text-accent' : '' }}"></i>
                <span>Koleksi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('playlists') }}" class="nav-link text-white rounded-3 px-3 py-2 d-flex align-items-center gap-3 {{ request()->is('playlists') ? 'active bg-primary bg-opacity-50 border-start border-3 border-accent' : 'text-white-50 hover-primary' }}">
                <i class="bx bx-list-music fs-5 {{ request()->is('playlists') ? 'text-accent' : '' }}"></i>
                <span>Playlists</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('posting') }}" class="nav-link text-white rounded-3 px-3 py-2 d-flex align-items-center gap-3 {{ request()->is('posting') ? 'active bg-primary bg-opacity-50 border-start border-3 border-accent' : 'text-white-50 hover-primary' }}">
                <i class="bx bx-plus-circle fs-5 {{ request()->is('posting') ? 'text-accent' : '' }}"></i>
                <span>Posting</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('profile') }}" class="nav-link text-white rounded-3 px-3 py-2 d-flex align-items-center gap-3 {{ request()->is('profile') ? 'active bg-primary bg-opacity-50 border-start border-3 border-accent' : 'text-white-50 hover-primary' }}">
                <i class="bx bx-user fs-5 {{ request()->is('profile') ? 'text-accent' : '' }}"></i>
                <span>Profile</span>
            </a>
        </li>
    </ul>
</div>
