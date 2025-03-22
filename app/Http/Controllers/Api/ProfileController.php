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
    public function indexProfile() {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Profil',
            'profiles' => $user
        ], 200);

        // // Ambil user beserta data siswa yang berelasi
        // $userWith = User::with('siswa')->find($user->id);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Detail Profil',
        //     'profiles' => $userWithSiswa
        // ], 200);
    }
}
