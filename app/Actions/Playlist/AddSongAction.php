<?php

namespace App\Actions\Playlist;

use App\Models\Playlist;

class AddSongAction
{
    public function execute(Playlist $playlist, int $songId): bool
    {
        if ($playlist->songs()->where('song_id', $songId)->exists()) {
            return false;
        }

        $playlist->songs()->attach($songId);
        return true;
    }
}
