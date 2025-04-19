<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function indexAssets()
    {
        $assets = Asset::with(['creator', 'media'])->get();

        $data = $assets->map(function ($asset) {
            $media = $asset->getFirstMedia('images');
            return [
                'id' => $asset->id,
                'title' => $asset->title,
                'file_name' => $media ? $media->file_name : null,
                'description' => $asset->description,
                'image_url' => $media ? $media->getUrl() : null, // <--- ini kuncinya
                'creator' => [
                    'id' => $asset->creator->id,
                    'name' => $asset->creator->name,
                ],
            ];
        });

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail_url' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'file_url' => 'required|file|mimes:zip,rar,psd,ai,pdf,doc,docx,xlsx,txt|max:102400',
            'category_ids' => 'required|array|min:1',
            'tag_ids' => 'required|array|min:1',
        ]);

        $thumbnailPath = $request->file('thumbnail_url')->store('public/thumbnails');
        $filePath = $request->file('file_url')->store('private/files');

        $asset = Asset::create([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail_url' => $thumbnailPath,
            'file_url' => $filePath,
            'creator_id' => Auth::id(),
            'is_premium_only' => $request->is_premium_only ?? 0,
            'status' => 'pending',
        ]);

        $asset->category()->attach($request->category_ids);
        $asset->tags()->attach($request->tag_ids);

        return response()->json(['message' => 'Asset uploaded successfully', 'data' => $asset], 201);
    }

    public function serveFile($id)
    {
        $asset = Asset::findOrFail($id);

        if (!Storage::exists($asset->file_url)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        return response()->file(storage_path('app/' . $asset->file_url));
    }

    public function showAssets($id)
    {
        $asset = Asset::with(['category', 'tags', 'media'])->findOrFail($id);

        return response()->json([
            'id' => $asset->id,
            'title' => $asset->title,
            'description' => $asset->description,
            'category' => $asset->category,
            'tags' => $asset->tags,
            'image_url' => $asset->getFirstMediaUrl('images'),
            'download_url' => $asset->getFirstMediaUrl('assets'), // opsional
        ]);
    }
}
