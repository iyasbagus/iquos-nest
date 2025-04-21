<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $admin = User::role('admin')->get();
        $creators = User::role('creator')->get();

        // Tambahkan properti assets_terbaru ke setiap creator
        $creators->map(function ($creator) {
            $creator->latestAssets = $creator
                ->asset()
                ->with('media') // kalau pakai Spatie Media Library
                ->latest()
                ->take(3)
                ->where('status', 'active')
                ->get();
            return $creator;
        });

        return view('user.list-creator', compact('user', 'admin' ,'creators'));
    }

    public function showOtherProfile($username)
    {
        $user = Auth::user();
        $creator = \App\Models\User::where('username', $username)->firstOrFail();

        // Misalnya ambil juga aset yang diunggah oleh creator tersebut
        $assets = $creator->asset()->latest()->where('status', 'active')->get();

        return view('user.other-profile', compact('creator', 'assets', 'user'));
    }
}
