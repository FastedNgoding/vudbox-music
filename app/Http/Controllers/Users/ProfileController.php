<?php

namespace App\Http\Controllers\Users;

use App\Actions\Profile\UpdateProfileAction;
use App\Actions\Profile\UpdatePasswordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateProfileRequest;
use App\Http\Requests\Users\UpdatePasswordRequest;
use App\Models\Song;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $uploaded = Song::where('user_id', Auth::id())
            ->with('genre')
            ->orderByDesc('created_at')
            ->get();

        return view('pages.profile.index', compact('uploaded'));
    }

    public function edit()
    {
        return view('pages.profile.edit', ['user' => Auth::user()]);
    }

    public function update(UpdateProfileRequest $request, UpdateProfileAction $action): RedirectResponse
    {
        $action->execute(Auth::user(), $request->validated());

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(UpdatePasswordRequest $request, UpdatePasswordAction $action): RedirectResponse
    {
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $action->execute($user, $request->password);

        return redirect()->route('profile.index')->with('success', 'Password berhasil diubah!');
    }
}
