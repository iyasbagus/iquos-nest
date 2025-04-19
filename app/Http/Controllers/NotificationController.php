<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $notifications = $user->notifications;

        //tandai sebagai baca
        $user->unreadNotifications->markAsRead();

        return view('user.notification', compact('notifications', 'user'));
    }

    public function destroy($id)
    {
        $notif = Auth::user()->notifications()->where('id', $id)->firstOrFail();
        $notif->delete();

        return back()->with('success', 'Notifikasi dihapus.');
    }
}
