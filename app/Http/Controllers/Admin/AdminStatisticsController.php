<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

class AdminStatisticsController extends Controller
{
    public function index()
    {
        $genreStats = Genre::withCount('songs')
            ->orderByDesc('songs_count')
            ->get();

        $totalSongs = Song::count();

        $genreStats->transform(function ($genre) use ($totalSongs) {
            $genre->percentage = $totalSongs > 0
                ? round(($genre->songs_count / $totalSongs) * 100)
                : 0;
            return $genre;
        });

        $stats = [
            'total_songs'    => $totalSongs,
            'total_users'    => User::where('role', 'user')->count(),
            'total_genres'   => Genre::count(),
            'songs_this_week' => Song::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'users_this_week' => User::where('role', 'user')
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->count(),
        ];

        $monthlySongs = Song::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        return view('admin.pages.statistics', compact('genreStats', 'stats', 'monthlySongs'));
    }
}
