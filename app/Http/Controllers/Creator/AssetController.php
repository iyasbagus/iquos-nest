<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public function index()
    {
        $asset = Asset::where([['creator_id', Auth::id()], ['status', 'active']])->get();
        $category = Category::all();
        return view('creator.asset.index', compact('asset', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $creator_id = User::all();
        return view();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'thumbnail_url' => 'required|image|mimes:jpg,jpeg,png,gif',
            'file_url' => 'required|file|mimes:zip,rar,psd,ai,pdf,doc,docx,xlsx,txt',
            'category_ids' => 'required|array', // User harus pilih minimal 1 kategori
        ]);

        $asset = new Asset();
        $asset->title = $request->title;
        $asset->description = $request->description;
        $asset->creator_id = Auth::id();
        $asset->is_premium_only = $request->is_premium_only ?? 0;
        $asset->downloads = $request->downloads ?? 0;
        $asset->rating = $request->rating ?? 0;
        $asset->status = $request->status ?? 'pending';

        if ($request->hasFile('thumbnail_url')) {
            $img = $request->file('thumbnail_url');
            $name = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move('admin/images/asset/', $name);
            $asset->thumbnail_url = $name;
        }

        if ($request->hasFile('file_url')) {
            $file = $request->file('file_url');
            $file_name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file_path = $file->storeAs('public/files', $file_name);

            $asset->file_url = str_replace('public/', 'storage', $file_path);
        }

        $asset->save();

        $asset->category()->attach($request->category_ids);

        return redirect()->route('asset.index')->with('success', 'Asset uploaded and waiting for approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         // Ambil asset beserta kategori yang terkait
        $asset = Asset::with('category')->findOrFail($id);

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
