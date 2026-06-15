<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSongController extends Controller
{
    public function index(Request $request)
    {
        $songs = Song::with('user', 'genre')
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%")
                ->orWhere('artist', 'like', "%{$request->search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.pages.songs', compact('songs'));
    }

    public function destroy(Song $song): RedirectResponse
    {
        if ($song->audio_path) {
            Storage::disk('public')->delete($song->audio_path);
        }

        if ($song->cover_art_path) {
            Storage::disk('public')->delete($song->cover_art_path);
        }

        $song->delete();

        return back()->with('success', 'Lagu berhasil dihapus.');
    }
}
