<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileUserController extends Controller
{
    /**
     * Display the user's profile form.
     */
    // public function showProfile($id)
    // {
    //     $user = User::where('username', $username)->firstOrFail();

    //     // ambil semua asset yang dibuat user ini
    //     $assets = $user->assets()->latest()->paginate(9);

    //     return view('user.profile', compact('user', 'assets'));
    // }

    public function show()
    {
        $user = Auth::user(); // user yang login
        $assets = $user->asset()->latest()->paginate(9)->where('status', 'active'); // ambil asset yang dia upload

        return view('user.profile', compact('user', 'assets'));
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        $user->clearMediaCollection('profile_picture');
        // Simpan ke media library
        $user->addMediaFromRequest('profile_picture')->toMediaCollection('profile_picture');

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function updateBanner(Request $request)
    {
        $request->validate([
            'banner' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        $user = Auth::user();

        $user->clearMediaCollection('banner_image');
        // Simpan ke media library
        $user->addMediaFromRequest('banner_image')->toMediaCollection('banner_image');

        return back()->with('success', 'Banner berhasil diperbarui');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|alpha_dash|unique:users,username,' . auth()->id(),
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'bio' => $request->bio,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
