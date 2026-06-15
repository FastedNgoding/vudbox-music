@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="text-white fw-bold mb-1">Kelola Lagu</h2>
            <p class="text-white-50 mb-0">Manajemen semua lagu yang diunggah pengguna.</p>
        </div>
        <div class="d-flex gap-2">
            <div class="position-relative">
                <input type="text" class="form-control bg-secondary border-0 text-white shadow-none ps-5 py-2 rounded-pill"
                    placeholder="Cari lagu...">
                <i class="bx bx-search position-absolute top-50 translate-middle-y text-white-50"
                    style="left: 15px; font-size: 18px;"></i>
            </div>
            <button
                class="btn btn-secondary border-0 rounded-pill px-3 text-white-50 hover-primary d-flex align-items-center gap-2">
                <i class="bx bx-filter-alt"></i> Filter
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover table-borderless align-middle mb-0">
            <thead class="text-white-50 border-bottom border-dark border-opacity-25">
                <tr>
                    <th class="fw-medium pb-3 ps-3">Lagu</th>
                    <th class="fw-medium pb-3">Artis</th>
                    <th class="fw-medium pb-3">Genre</th>
                    <th class="fw-medium pb-3">Status</th>
                    <th class="fw-medium pb-3 text-end pe-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($songs as $song)
                    <tr>
                        <td class="ps-3 py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary rounded text-accent d-flex align-items-center justify-content-center overflow-hidden"
                                    style="width: 45px; height: 45px;">
                                    @if ($song->cover_art_path)
                                        <img src="{{ Storage::url($song->cover_art_path) }}"
                                            class="img-fluid w-100 h-100 object-fit-cover" alt="Cover">
                                    @else
                                        <i class="bx bx-music fs-5"></i>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="text-white fw-semibold mb-0">{{ $song->title }}</h6>
                                    <small class="text-white-50">#SNG-{{ $song->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td
                            class="text-white-50 py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                            {{ $song->artist }}</td>
                        <td
                            class="text-white-50 py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                            {{ $song->genre->name ?? '-' }}</td>
                        <td class="py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}"><span
                                class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Publik</span>
                        </td>
                        <td
                            class="text-end pe-3 py-3 {{ !$loop->first ? 'border-top border-dark border-opacity-25' : '' }}">
                            <button class="btn btn-sm btn-outline-light border-0 text-danger hover-primary rounded-circle"
                                data-bs-toggle="modal" data-bs-target="#deleteSongModal{{ $song->id }}"><i
                                    class="bx bx-trash fs-5"></i></button>
                        </td>
                    </tr>

                    <!-- Modal Delete Song -->
                    <div class="modal fade" id="deleteSongModal{{ $song->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div
                                class="modal-content bg-secondary border border-secondary border-opacity-25 rounded-4 text-white">
                                <div class="modal-header border-bottom border-secondary border-opacity-10">
                                    <h5 class="modal-title fw-bold">Hapus Lagu</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <p class="text-white-50">Apakah Anda yakin ingin menghapus lagu <strong
                                            class="text-white">{{ $song->title }}</strong>?</p>
                                </div>
                                <div class="modal-footer border-top border-secondary border-opacity-10">
                                    <button type="button" class="btn btn-outline-light rounded-pill px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('admin.songs.destroy', $song->id) }}" method="POST"
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
                        <td colspan="6" class="text-center text-white-50 py-4">Belum ada lagu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4 border-top border-dark border-opacity-25 pt-3">
            {{ $songs->links() }}
        </div>
    </div>
@endsection
