<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Asset;
use App\Models\CreatorApplication;
use App\Models\CreatorEarning;
use App\Models\PremiumPayment;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        //total keseluruhan category
        $categoryTotal = Category::count();
        $totalRevenue = PremiumPayment::where('status', 'completed')->sum('amount');

        //total asset yang sudah diaktifin sama atmin
        $assetTotalActive = Asset::where('status', 'active')->count();

        //total keseluruhan user
        $userTotal = User::count();

        // total lamaran menjadi creator
        $applicationTotal = CreatorApplication::count();

        //total lamaran hari ini
        $applicationTotalToday = CreatorApplication::whereDate('created_at', Carbon::today())->count();

        //asset yang ditambahkan hari ini
        $assetToday = Asset::where('status', 'active')->whereDate('updated_at', Carbon::today())->count();

        //User yang register hari ini
        $userTodayRegister = User::whereDate('created_at', Carbon::today())->count();

        return view('dashboard', compact('user','categoryTotal', 'totalRevenue','assetTotalActive', 'userTotal', 'assetToday', 'userTodayRegister', 'applicationTotal', 'applicationTotalToday'));
    }

    public function creatorDashboard()
    {
        $user = Auth::user();
        $startMonth = Carbon::now()->startOfMonth();
        $endMonth = Carbon::now()->endOfMonth();
        $totalEarning = $user->totalEarnings();

        $assetsToday = Asset::whereDate('created_at', Carbon::today())
            ->where('status', 'active')
            ->whereHas('creator.roles', function ($query) {
                $query->where('name', 'creator');
            })
            ->count();

        $assetsMonth = Asset::whereBetween('created_at', [$startMonth, $endMonth])
            ->where('status', 'active') // hanya asset yang status-nya active
            ->whereHas('creator.roles', function ($query) {
                $query->where('name', 'creator');
            })
            ->count();

        return view('creator.dashboard', compact('user','assetsMonth', 'assetsToday','totalEarning'));
    }
}
