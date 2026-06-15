<?php

namespace App\Http\Controllers\Users;

use App\Actions\Playlist\AddSongAction;
use App\Actions\Playlist\RemoveSongAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\PlaylistRequest;
use App\Http\Requests\Users\AddSongToPlaylistRequest;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::withCount('songs')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.playlists.index', compact('playlists'));
    }

    public function store(PlaylistRequest $request): RedirectResponse
    {
        Playlist::create([
            ...$request->validated(),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('playlists.index')->with('success', 'Playlist berhasil dibuat!');
    }

    public function show(Playlist $playlist)
    {
        if ($playlist->user_id !== Auth::id()) {
            abort(403);
        }

        $playlist->load('songs.user', 'songs.genre', 'user');

        return view('pages.playlists.show', compact('playlist'));
    }

    public function edit(Playlist $playlist)
    {
        if ($playlist->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pages.playlists.edit', compact('playlist'));
    }

    public function update(PlaylistRequest $request, Playlist $playlist): RedirectResponse
    {
        if ($playlist->user_id !== Auth::id()) {
            abort(403);
        }

        $playlist->update($request->validated());

        return redirect()->route('playlists.show', $playlist)->with('success', 'Playlist berhasil diperbarui!');
    }

    public function destroy(Playlist $playlist): RedirectResponse
    {
        if ($playlist->user_id !== Auth::id()) {
            abort(403);
        }

        $playlist->delete();

        return redirect()->route('playlists.index')->with('success', 'Playlist berhasil dihapus!');
    }

    public function addSong(AddSongToPlaylistRequest $request, Playlist $playlist, AddSongAction $action): RedirectResponse
    {
        if ($playlist->user_id !== Auth::id()) {
            abort(403);
        }

        $added = $action->execute($playlist, $request->song_id);

        if (!$added) {
            return back()->with('error', 'Lagu sudah ada di playlist ini.');
        }

        return back()->with('success', 'Lagu berhasil ditambahkan ke playlist!');
    }

    public function removeSong(Playlist $playlist, Song $song, RemoveSongAction $action): RedirectResponse
    {
        if ($playlist->user_id !== Auth::id()) {
            abort(403);
        }

        $action->execute($playlist, $song);

        return back()->with('success', 'Lagu berhasil dihapus dari playlist!');
    }
}
