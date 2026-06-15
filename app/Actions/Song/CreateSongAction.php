<?php

namespace App\Actions\Song;

use App\Models\Song;

class CreateSongAction
{
    public function execute(array $data, $audioFile, $coverFile, int $userId): Song
    {
        $audioPath = $audioFile->store('songs', 'public');
        $coverPath = $coverFile ? $coverFile->store('cover', 'public') : null;

        return Song::create([
            'title'          => $data['title'],
            'artist'         => $data['artist'],
            'album'          => $data['album'] ?? null,
            'audio_path'     => $audioPath,
            'cover_art_path' => $coverPath,
            'user_id'        => $userId,
            'genre_id'       => $data['genre_id'] ?? null,
        ]);
    }
}
