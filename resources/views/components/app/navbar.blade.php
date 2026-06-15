<nav>
    <div class="navbar w-100">
        <div class="container-fluid px-5">
            <a class="navbar-brand hover-scale" href="{{ route('landing-page') }}">
                <img src="{{ url('logo.png') }}" alt="Logo" width="30" height="30"
                    class="d-inline-block align-text-top">
                <b class="text-foreground">VudBox</b>
            </a>
            <div class="d-flex align-items-center gap-2">
                <form action="{{ route('landing-page') }}" method="GET" class="d-flex align-items-center position-relative me-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control navbar-search-input bg-secondary border-0 text-white shadow-none ps-3 pe-5 py-1.5 rounded-pill"
                        placeholder="Cari musik...">
                    <button type="submit" class="bg-transparent border-0 p-0 position-absolute end-0 top-50 translate-middle-y me-3 text-accent hover-scale">
                        <i class="bx bx-search fs-5"></i>
                    </button>
                </form>
                <div class="dropdown">
                    <button class="btn text-foreground fs-3 hover-scale border-0 p-1" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-user-circle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end bg-secondary border-0 shadow-lg mt-2">
                        <li>
                            <a class="dropdown-item text-white hover-primary py-2"
                                href="{{ url('profile') }}"><i class="bx bx-user me-2"></i>Profile</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider border-dark opacity-25">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger hover-primary py-2"><i
                                        class="bx bx-log-out me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
