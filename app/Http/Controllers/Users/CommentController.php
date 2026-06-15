<?php

namespace App\Http\Controllers\Users;

use App\Actions\Comment\StoreCommentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Song;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Song $song, StoreCommentAction $action): RedirectResponse
    {
        $action->execute(
            $request->body,
            $song->id,
            Auth::id()
        );

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}
