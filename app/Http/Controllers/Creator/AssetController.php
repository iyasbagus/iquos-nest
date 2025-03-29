<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;

use App\Models\Asset;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\Facades\Image;

class AssetController extends Controller
{
    public function index()
    {
        $asset = Asset::where([['creator_id', Auth::id()], ['status', 'active']])->get();
        $category = Category::all();
        $tag = Tag::all();

        $assetTotalCreator = Asset::where('creator_id', Auth::id())->count();

        return view('creator.asset.index', compact('asset', 'category', 'tag', 'assetTotalCreator'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
            'file' => 'required|file|mimes:zip,rar,psd,ai,pdf,doc,docx,xlsx,txt|max:102400',
            'category_ids' => 'required|array|min:1',
            'tag_ids' => 'required|array|min:1',
        ]);

        // Simpan data asset
        $asset = new Asset();
        $asset->title = $request->title;
        $asset->description = $request->description;
        $asset->creator_id = Auth::id();
        $asset->is_premium_only = $request->is_premium_only ?? 0;
        $asset->downloads = $request->downloads ?? 0;
        $asset->rating = $request->rating ?? 0;
        $asset->status = $request->status ?? 'pending';
        $asset->save();

        // 🔹 Simpan file ke Media Library dengan nama unik
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = now()->timestamp . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            $asset->addMedia($file)->usingFileName($fileName)->toMediaCollection('assets', 'public');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = now()->timestamp . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            $media = $asset->addMedia($image)->usingFileName($imageName)->toMediaCollection('images', 'public');

            // 🔹 Simpan ukuran asli gambar
            $imagePath = $media->getPath();
            $img = Image::make($imagePath);

            $media->setCustomProperty('original_width', $img->width());
            $media->setCustomProperty('original_height', $img->height());
            $media->save(); // Simpan perubahan properti
        }

        // Hubungkan kategori dan tag
        $asset->category()->attach($request->category_ids);
        $asset->tags()->attach($request->tag_ids);

        return redirect()->route('asset.index')->with('success', 'Asset uploaded and waiting for approval.');
    }

    public function show($id)
    {
        // Ambil asset beserta kategori yang terkait
        $asset = Asset::with('category', 'tags')->findOrFail($id);

        return view('creator.asset.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        //
    }

}
