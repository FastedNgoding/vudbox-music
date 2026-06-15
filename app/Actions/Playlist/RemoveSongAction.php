<?php

namespace App\Actions\Playlist;

use App\Models\Playlist;
use App\Models\Song;

class RemoveSongAction
{
    public function execute(Playlist $playlist, Song $song): void
    {
        $playlist->songs()->detach($song->id);
    }
}
