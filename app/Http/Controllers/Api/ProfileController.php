<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function indexProfile()
    {
        $user = \App\Models\User::with('media')->find(Auth::id());

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $mediaProfile = $user->getFirstMedia('profile_picture');
        $mediaBanner = $user->getFirstMedia('banner_image');

        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'profile_picture_name' => $mediaProfile ? $mediaProfile->file_name : null,
            'banner_name' => $mediaBanner ? $mediaBanner->file_name : null,
            'bio' => $user->bio,
            'profile_picture' => $mediaProfile ? $mediaProfile->getUrl() : null,
            'banner_image' => $mediaBanner ? $mediaBanner->getUrl() : null,
        ];

        return response()->json($data);

        // if (!$user) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'User tidak ditemukan',
        //     ], 404);
        // }

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Detail Profil',
        //     'profiles' => $user
        // ], 200);

        // // Ambil user beserta data siswa yang berelasi
        // $userWith = User::with('siswa')->find($user->id);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Detail Profil',
        //     'profiles' => $userWithSiswa
        // ], 200);
    }
}
