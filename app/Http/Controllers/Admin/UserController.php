<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $user = User::all();

        $userTotal = User::count();

        return view('admin.user.index', compact('user', 'userTotal'));
    }
}
