<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Asset;
use App\Models\Tag;

use App\Models\AssetCategory;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AssetAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assetTotal = Asset::count();

        $asset = Asset::all();
        $category = Category::all();
        return view('admin.asset.index', compact('asset', 'category', 'assetTotal'));
    }

    public function active($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->update(['status' => 'active']);

        return redirect()->back()->with('success', 'Asset has been actived.');
    }

    public function rejected($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->update(['status' => 'rejected']);

        return redirect()->back()->with('error', 'Asset has been rejected.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    // Error Tai
    public function show($id)
    {
        // Ambil asset beserta kategori yang terkait
        $asset = Asset::with('category', 'tags')->findOrFail($id);

        return view('admin.asset.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        $categories = Category::all();
        $tags = Tag::all(); // Semua tag yang tersedia

        // Ambil kategori yang sudah dipilih untuk aset ini
        $selectedCategories = $asset->category()->pluck('id')->toArray();
        $selectedTags = $asset->tags()->get(['id', 'name']); // Tag yang sudah terkait dengan asset

        return view('admin.asset.edit', compact('asset', 'categories', 'tags', 'selectedTags', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'thumbnail_url' => $request->isMethod('post') ? 'required|image|mimes:jpg,jpeg,png,gif' : 'nullable|image|mimes:jpg,jpeg,png,gif',
            'file_url' => $request->isMethod('post') ? 'required|file|mimes:zip,rar,psd,ai,pdf,doc,docx,xlsx,txt|max:102400' : 'nullable|file|mimes:zip,rar,psd,ai,pdf,doc,docx,xlsx,txt|max:102400',
            'category_ids' => 'required|array|min:1',
            'tag_ids' => 'required|array|min:1',
        ]);

        $asset = Asset::findOrFail($id);
        $asset->title = $request->title;
        $asset->description = $request->description;
        $asset->creator_id = Auth::id();
        $asset->is_premium_only = $request->is_premium_only ?? 0;
        $asset->downloads = $request->downloads ?? 0;
        $asset->rating = $request->rating ?? 0;

        if ($request->hasFile('thumbnail_url')) {
            // Hapus thumbnail lama jika ada
            if ($asset->thumbnail_url && file_exists(public_path('admin/images/asset/' . $asset->thumbnail_url))) {
                unlink(public_path('admin/images/asset/' . $asset->thumbnail_url));
            }

            // Simpan thumbnail baru
            $img = $request->file('thumbnail_url');
            $name = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('admin/images/asset/'), $name);
            $asset->thumbnail_url = $name;
        }

        if ($request->hasFile('file_url')) {
            // Hapus file lama jika ada
            if ($asset->file_url && Storage::exists($asset->file_url)) {
                Storage::delete($asset->file_url);
            }

            // Simpan file baru
            $file = $request->file('file_url');
            $file_name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs('private/files', $file_name);
            $asset->file_url = $file_path;
        }

        $asset->save();

        $asset->category()->sync($request->category_ids);

        $asset->tags()->sync($request->tag_ids);

        return redirect()->route('adminAsset.index')->with('success', 'Asset uploaded and waiting for approval.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asset = Asset::where('id', $id)->firstOrFail();

        if (!$asset) {
            return redirect()->back()->with('error', 'Asset Not Found');
        }

        $file_path = public_path('admin/images/asset/' . $asset->thumbnail_url);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }

        $asset->delete();

        return redirect()->route('adminAsset.index')->with('success', 'Berhasil Dihapus');
    }
}
