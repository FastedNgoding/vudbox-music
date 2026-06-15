<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $search = request('search');

        $query = Song::with('user', 'genre');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('artist', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', '%' . $search . '%')
                        ->orWhere('username', 'like', '%' . $search . '%');
                  });
            });
        }

        $data = $query->latest()->get();

        $playlists = Auth::user()
            ? Auth::user()->playlists()->withCount('songs')->get()
            : collect();

        return view('pages.home.index', compact('data', 'playlists'));
    }
}
