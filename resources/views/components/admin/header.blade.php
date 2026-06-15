<header class="admin-header shadow-sm py-3 px-4 d-flex align-items-center justify-content-between sticky-top">
    <button class="btn border-0 text-white d-lg-none" onclick="document.getElementById('adminSidebar').classList.add('show')">
        <i class="bx bx-menu fs-3"></i>
    </button>
    <div class="ms-auto d-flex align-items-center gap-3">
        <button class="btn btn-sm text-white position-relative hover-scale">
            <i class="bx bx-bell fs-4"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                <span class="visually-hidden">New alerts</span>
            </span>
        </button>
        <div class="dropdown">
            <button class="btn text-foreground d-flex align-items-center gap-2 border-0 p-1" type="button" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=948979&color=fff" alt="Admin" class="rounded-circle" width="35" height="35">
                <span class="d-none d-md-inline fw-semibold text-white">{{ Auth::user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end bg-secondary border-0 shadow-lg mt-2">
                <li><a class="dropdown-item text-white hover-primary py-2" href="{{ route('profile.index') }}"><i class="bx bx-user me-2"></i>Profil Admin</a></li>
                <li><hr class="dropdown-divider border-dark opacity-25"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger hover-primary py-2"><i class="bx bx-log-out me-2"></i>Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
