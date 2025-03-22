<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Asset;

class ExploreController extends Controller
{
    public function listAssetView()
    {
        $category = Category::all();
        $asset = Asset::all();

        return view('user.explore', compact('category', 'asset'));
    }
}
