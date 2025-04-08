<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\User;

class AssignUserRole
{
    public function handle(Registered $event): void
    {
        $user = $event->user;
        $user->assignRole('user'); // Pastikan role 'user' sudah ada
    }
}
