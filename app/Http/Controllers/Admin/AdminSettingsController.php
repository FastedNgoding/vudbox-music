<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $genres = Genre::orderBy('name')->get();
        $phpVersion = PHP_VERSION;
        $laravelVersion = app()->version();

        return view('admin.pages.settings', compact('genres', 'phpVersion', 'laravelVersion'));
    }

    public function storeGenre(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:50|unique:genres,name',
        ]);

        Genre::create([
            'name' => $data['name'],
            'slug' => \Illuminate\Support\Str::slug($data['name']),
        ]);

        return back()->with('success', 'Genre berhasil ditambahkan.');
    }

    public function destroyGenre(Genre $genre): RedirectResponse
    {
        $genre->delete();

        return back()->with('success', 'Genre berhasil dihapus.');
    }
}
