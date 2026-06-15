<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_songs'  => Song::count(),
            'total_users'  => User::where('role', 'user')->count(),
            'total_genres' => Genre::count(),
        ];

        $recent_songs = Song::with('user', 'genre')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.pages.dashboard', compact('stats', 'recent_songs'));
    }
}
