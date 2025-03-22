<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Asset;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $asset = Asset::all();

        return view('welcome', compact('category', 'asset'));
    }
}
