<?php

namespace App\Actions\Song;

use App\Models\Song;
use Illuminate\Support\Facades\Storage;

class UpdateSongAction
{
    public function execute(Song $song, array $data, $audioFile = null, $coverFile = null): Song
    {
        if ($audioFile) {
            Storage::disk('public')->delete($song->audio_path);
            $song->audio_path = $audioFile->store('songs', 'public');
        }

        if ($coverFile) {
            if ($song->cover_art_path) {
                Storage::disk('public')->delete($song->cover_art_path);
            }
            $song->cover_art_path = $coverFile->store('cover', 'public');
        }

        $song->title    = $data['title'];
        $song->artist   = $data['artist'];
        $song->album    = $data['album'] ?? null;
        $song->genre_id = $data['genre_id'] ?? null;
        $song->save();

        return $song;
    }
}
