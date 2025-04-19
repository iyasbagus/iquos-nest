<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $allUser = User::all();
        $category = Category::all();
        $asset = Asset::all();

        return view('welcome', compact('category', 'asset', 'allUser' ,'user'));
    }
}
