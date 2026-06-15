<aside class="admin-sidebar shadow-lg d-flex flex-column transition-transform" id="adminSidebar">
    <div class="p-4 d-flex align-items-center justify-content-between">
        <a href="{{ url('') }}" class="text-decoration-none d-flex align-items-center gap-2">
            <img src="{{ url('logo.png') }}" alt="Logo" width="35" height="35">
            <b class="text-foreground fs-5 mb-0">VudBox</b>
        </a>
        <button class="btn btn-sm d-lg-none text-white" onclick="document.getElementById('adminSidebar').classList.remove('show')">
            <i class="bx bx-x fs-3"></i>
        </button>
    </div>
    
    <div class="px-3 pb-3 mt-2 overflow-y-auto flex-grow-1">
        <ul class="nav flex-column gap-2">
            <li class="nav-item">
                <a href="{{ url('admin') }}" class="nav-link text-white rounded-3 px-3 py-2 d-flex align-items-center gap-3 {{ request()->is('admin') ? 'active bg-primary bg-opacity-50 border-start border-3 border-accent' : 'text-white-50 hover-primary' }}">
                    <i class="bx bx-dashboard fs-5 {{ request()->is('admin') ? 'text-accent' : '' }}"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/songs') }}" class="nav-link text-white rounded-3 px-3 py-2 d-flex align-items-center gap-3 {{ request()->is('admin/songs') ? 'active bg-primary bg-opacity-50 border-start border-3 border-accent' : 'text-white-50 hover-primary' }}">
                    <i class="bx bx-music fs-5 {{ request()->is('admin/songs') ? 'text-accent' : '' }}"></i>
                    <span>Kelola Lagu</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/users') }}" class="nav-link text-white rounded-3 px-3 py-2 d-flex align-items-center gap-3 {{ request()->is('admin/users') ? 'active bg-primary bg-opacity-50 border-start border-3 border-accent' : 'text-white-50 hover-primary' }}">
                    <i class="bx bx-user fs-5 {{ request()->is('admin/users') ? 'text-accent' : '' }}"></i>
                    <span>Pengguna</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
