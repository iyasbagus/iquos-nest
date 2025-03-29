<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Asset;
use App\Models\Tag;

use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ExploreController extends Controller
{
    public function listAssetView()
    {
        $category = Category::all();
        $asset = Asset::with('tags', 'media')->get();
        $tags = Tag::all();

        return view('user.explore', compact('category', 'asset', 'tags'));
    }

    public function downloadImageById(Request $request)
    {
        $modelId = $request->query('modelId');
        $collectionName = $request->query('collection');
        $size = $request->query('size', 'original');

        // Cari media berdasarkan model_id dan collection_name
        $media = Media::where('model_id', $modelId)->where('collection_name', $collectionName)->first();

        if (!$media) {
            return abort(404, 'Media not found');
        }

        // Pilih path sesuai ukuran
        if ($size === 'small') {
            $path = $media->getPath('small');
        } elseif ($size === 'medium') {
            $path = $media->getPath('medium');
        } elseif ($size === 'large') {
            $path = $media->getPath('large');
        } else {
            $path = $media->getPath(); // original
        }

        // // Ambil path file
        // $path = $media->getPath();

        if (!file_exists($path)) {
            return abort(404, 'File not found');
        }

        return response()->download($path, $media->file_name);
    }
}
