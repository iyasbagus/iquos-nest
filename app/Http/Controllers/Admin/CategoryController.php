<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::with('assets')->get();

        $categoryTotal = Category::count();

        return view('admin.category.index', compact('category', 'categoryTotal'));
    }

    public function create()
    {
        return view();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
            'description' => 'required',
            'images' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->save();

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = now()->timestamp . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            $media = $category->addMedia($image)->usingFileName($imageName)->toMediaCollection('category', 'public');

            // 🔹 Simpan ukuran asli gambar
            $imagePath = $media->getPath();
            $img = Image::make($imagePath);

            $media->save(); // Simpan perubahan properti
        }

        return redirect()->route('category.index')->with('success', 'data berhasil ditambahkan');
    }

    // public function show($slug)
    // {
    //     $category = Category::where('slug', $slug)->firstOrFail();
    //     return view('admin.category.show', compact('category'));
    // }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,' . $slug . ',slug',
            'description' => 'required',
            'images' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        $category = Category::where('slug', $slug)->firstOrFail();

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->save();

        if ($request->hasFile('images')) {
            // 🔸 Hapus media lama terlebih dahulu
            $category->clearMediaCollection('category');

            $image = $request->file('images');
            $imageName = now()->timestamp . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            $media = $category->addMedia($image)->usingFileName($imageName)->toMediaCollection('category', 'public');

            // 🔹 Simpan ukuran asli gambar
            $imagePath = $media->getPath();
            $img = Image::make($imagePath);

            $media->save(); // Simpan perubahan properti
        }

        return redirect()->route('category.index')->with('success', 'data berhasil di edit');
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        if ($category->assets()->count() > 0){
            return redirect()->back()->with('error', 'The category cannot be deleted because it still has assets.');
        }

        $category->delete();

        return redirect()->route('category.index')->with('success', 'data berhasil dihapus');
    }
}
