<?php

namespace App\Http\Controllers\Users;

use App\Actions\Song\CreateSongAction;
use App\Actions\Song\UpdateSongAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\PostingRequest;
use App\Models\Genre;
use App\Models\Song;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    public function posting()
    {
        $genres = Genre::orderBy('name')->get();

        return view('pages.posting.index', compact('genres'));
    }

    public function store(PostingRequest $request, CreateSongAction $action): RedirectResponse
    {
        $action->execute(
            $request->validated(),
            $request->file('audio'),
            $request->file('cover'),
            Auth::id()
        );

        return redirect()->route('profile.index')->with('success', 'Lagu berhasil diposting!');
    }

    public function show(Song $song)
    {
        $song->load('user', 'genre', 'comments.user');

        $playlists = Auth::user()
            ? Auth::user()->playlists()->withCount('songs')->get()
            : collect();

        return view('pages.songs.show', compact('song', 'playlists'));
    }

    public function edit(Song $song)
    {
        if ($song->user_id !== Auth::id()) {
            abort(403);
        }

        $genres = Genre::orderBy('name')->get();

        return view('pages.songs.edit', compact('song', 'genres'));
    }

    public function update(PostingRequest $request, Song $song, UpdateSongAction $action): RedirectResponse
    {
        if ($song->user_id !== Auth::id()) {
            abort(403);
        }

        $action->execute(
            $song,
            $request->validated(),
            $request->file('audio'),
            $request->file('cover')
        );

        return redirect()->back()->with('success', 'Lagu berhasil diperbarui!');
    }

    public function destroy(Song $song): RedirectResponse
    {
        if ($song->user_id !== Auth::id()) {
            abort(403);
        }

        Storage::disk('public')->delete([$song->audio_path, $song->cover_art_path]);
        $song->delete();

        return redirect()->back()->with('success', 'Lagu berhasil dihapus!');
    }
}
