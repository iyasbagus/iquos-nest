<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Asset;
use App\Models\CreatorApplication;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //total keseluruhan category
        $categoryTotal = Category::count();

        //total asset yang sudah diaktifin sama atmin
        $assetTotalActive = Asset::where('status', 'active')->count();

        //total keseluruhan user
        $userTotal = User::count();

        // total lamaran menjadi creator
        $applicationTotal = CreatorApplication::count();

        //total lamaran hari ini
        $applicationTotalToday = CreatorApplication::whereDate('created_at', Carbon::today())->count();

        //asset yang ditambahkan hari ini
        $assetToday = Asset::where('status', 'active')
        ->whereDate('updated_at', Carbon::today())->count();

        //User yang register hari ini
        $userTodayRegister = User::whereDate('created_at', Carbon::today())->count();

        return view('dashboard',compact('categoryTotal', 'assetTotalActive', 'userTotal' ,'assetToday', 'userTodayRegister', 'applicationTotal', 'applicationTotalToday'));
    }

    public function creatorDashboard()
    {
        return view('creator.dashboard');
    }
}
