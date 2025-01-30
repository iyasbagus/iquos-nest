<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{

    public function index()
    {
        $asset = Asset::all();

        return view('creator.asset.index', compact('asset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view();
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'images' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        $asset = new Asset();
        $asset->title = $request->title;
        $asset->description = $request->description;
        $asset->file_url = $request->file_url;

        if ($request->hasFile('images')) {
            $img = $request->file('images');
            $name = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move('admin/images/asset/', $name);
            $asset->images = $name;
        }

        $asset->save();

        return redirect()->route('asset.index')
            ->with('success', 'data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
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
