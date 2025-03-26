<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Asset;
use App\Models\Tag;

use Illuminate\Support\Facades\Storage;

class ExploreController extends Controller
{
    public function listAssetView()
    {
        $category = Category::all();
        $asset = Asset::with('tags')->get();
        $tags = Tag::all();

        return view('user.explore', compact('category', 'asset', 'tags'));
    }

    public function downloadAsset($id)
    {
        $asset = Asset::findOrFail($id);

        $filePath = $asset->file_url;

        // Pastikan file ada di storage
        if (!Storage::exists($filePath)) {
            abort(404, 'File not found!');
        }

        // Ambil path file yang sesuai dengan Laravel storage
        return response()->download(Storage::path($filePath));
    }

    public function downloadImage($id)
    {
        $asset = Asset::findOrFail($id);

        if (!Storage::disk('public')->exists($asset->thumbnail_url)) {
            abort(404, 'Thumbnail not found!');
        }

        return response()->download(storage_path('app/public/' . $asset->thumbnail_url));
    }
}
