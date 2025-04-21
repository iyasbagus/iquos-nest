<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Asset;
use App\Models\User;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $allUser = User::all();
        $creator = User::role('creator')->get();
        $category = Category::all();
        $asset = Asset::all();
        $plans = SubscriptionPlan::with('features')->get();

        return view('welcome', compact('category', 'asset', 'allUser', 'user', 'creator', 'plans'));
    }
}
