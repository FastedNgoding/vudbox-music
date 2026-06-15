<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSongController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\Users\CommentController;
use App\Http\Controllers\Users\PlaylistController;
use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Users\SongController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');

    Route::middleware(['verified', 'user'])->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('landing-page');

        Route::get('posting', [SongController::class, 'posting'])->name('posting');
        Route::post('song', [SongController::class, 'store'])->name('song.store');
        Route::get('song/{song}', [SongController::class, 'show'])->name('song.show');
        Route::get('song/{song}/edit', [SongController::class, 'edit'])->name('song.edit');
        Route::put('song/{song}', [SongController::class, 'update'])->name('song.update');
        Route::delete('song/{song}', [SongController::class, 'destroy'])->name('song.destroy');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        Route::resource('playlists', PlaylistController::class);
        Route::post('playlists/{playlist}/songs', [PlaylistController::class, 'addSong'])->name('playlists.add-song');
        Route::delete('playlists/{playlist}/songs/{song}', [PlaylistController::class, 'removeSong'])->name('playlists.remove-song');

        Route::post('songs/{song}/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

        Route::get('collection', function () {
            $songs = \App\Models\Song::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->with('genre')
                ->orderByDesc('created_at')
                ->get();
            $genres = \App\Models\Genre::orderBy('name')->get();
            return view('pages.collection.index', compact('songs', 'genres'));
        })->name('collection');
    });
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('songs', [AdminSongController::class, 'index'])->name('songs');
    Route::delete('songs/{song}', [AdminSongController::class, 'destroy'])->name('songs.destroy');

    Route::get('users', [AdminUserController::class, 'index'])->name('users');
    Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});
