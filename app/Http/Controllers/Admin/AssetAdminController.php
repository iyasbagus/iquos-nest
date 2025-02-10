<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AssetAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $asset = Asset::all();
        $category = Category::all();
        return view('admin.asset.index', compact('asset', 'category'));
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
        $asset = Asset::with('category')->findOrFail($id);

        return view('admin.asset.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asset = Asset::where('id', $id)->firstOrFail();

        if(!$asset) {
            return redirect()->back()->with('error', 'Asset Not Found');
        }

        $file_path = public_path('admin/images/asset/' . $asset->thumbnail_url);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }

        $asset->delete();

        return redirect()->route('adminAsset.index')
        ->with('success', 'Berhasil Dihapus');
    }
}
