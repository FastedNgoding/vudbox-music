<?php

namespace App\Actions\Comment;

use App\Models\Comment;

class StoreCommentAction
{
    public function execute(string $body, int $songId, int $userId): Comment
    {
        return Comment::create([
            'user_id' => $userId,
            'song_id' => $songId,
            'body'    => $body,
        ]);
    }
}
