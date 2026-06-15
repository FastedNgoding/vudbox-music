@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="text-white fw-bold mb-1">Manajemen Pengguna</h2>
            <p class="text-white-50 mb-0">Kelola data dan hak akses member VudBox.</p>
        </div>
        <form action="{{ route('admin.users') }}" method="GET" class="d-flex gap-2">
            <div class="position-relative">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="form-control bg-secondary border-0 text-white shadow-none ps-5 py-2 rounded-pill"
                    placeholder="Cari username...">
                <button type="submit"
                    class="bg-transparent border-0 p-0 position-absolute top-50 translate-middle-y text-white-50"
                    style="left: 15px;">
                    <i class="bx bx-search" style="font-size: 18px;"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover table-borderless align-middle mb-0">
            <thead class="text-white-50 border-bottom border-dark border-opacity-25">
                <tr>
                    <th class="fw-medium pb-3 ps-3">Pengguna</th>
                    <th class="fw-medium pb-3">Email</th>
                    <th class="fw-medium pb-3 text-center">Total Lagu</th>
                    <th class="fw-medium pb-3">Bergabung</th>
                    <th class="fw-medium pb-3">Status</th>
                    <th class="fw-medium pb-3 text-end pe-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($users as $user)
                    <tr>
                        <td class="ps-3 py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=948979&color=fff"
                                    class="rounded-circle" width="40" height="40" alt="Avatar">
                                <div>
                                    <h6 class="text-white fw-semibold mb-0">{{ $user->name }}</h6>
                                    <small class="text-white-50">{{ '@' . $user->username }}</small>
                                </div>
                            </div>
                        </td>
                        <td
                            class="text-white-50 py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                            {{ $user->email }}</td>
                        <td
                            class="text-center text-white py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                            {{ $user->songs_count }}</td>
                        <td
                            class="text-white-50 py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                            {{ $user->created_at->format('d M Y') }}</td>
                        <td class="py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}"><span
                                class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Aktif</span></td>
                        <td
                            class="text-end pe-3 py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                            <button class="btn btn-sm btn-outline-light border-0 text-danger hover-primary rounded-circle"
                                data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}"><i
                                    class="bx bx-trash fs-5"></i></button>
                        </td>
                    </tr>

                    <!-- Modal Delete User -->
                    <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div
                                class="modal-content bg-secondary border border-secondary border-opacity-25 rounded-4 text-white">
                                <div class="modal-header border-bottom border-secondary border-opacity-10">
                                    <h5 class="modal-title fw-bold">Hapus Pengguna</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <p class="text-white-50">Apakah Anda yakin ingin menghapus pengguna <strong
                                            class="text-white">{{ $user->name }}</strong>? Semua data lagu dan komentar
                                        milik pengguna ini juga akan terhapus.</p>
                                </div>
                                <div class="modal-footer border-top border-secondary border-opacity-10">
                                    <button type="button" class="btn btn-outline-light rounded-pill px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-pill px-4">Ya, Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-white-50 py-4">Belum ada pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4 border-top border-dark border-opacity-25 pt-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection
