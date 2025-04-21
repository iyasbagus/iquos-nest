<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::with(['media'])->get();

        $data = $category->map(function ($categories) {
            $media = $categories->getFirstMedia('category');
            return [
                'id' => $categories->id,
                'name' => $categories->name,
                'slug' => $categories->slug,
                'img_name' => $media ? $media->file_name : null,
                'description' => $categories->description,
                'images' => $media ? $media->getUrl() : null, // <--- ini kuncinya
            ];
        });

        return response()->json($data);
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|unique:categories,name|max:255',
        'description' => 'required|string',
        'images' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    // Simpan gambar ke folder public/admin/images/category
    $image = $request->file('images');
    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('admin/images/category'), $imageName);

    // Hanya simpan nama filenya di database
    $category = Category::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'images' => $imageName // Simpan hanya nama filenya
    ]);

    return response()->json(['message' => 'Category created', 'data' => $category], 201);
}

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return response()->json($category, 200);
    }

    public function update(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
            'description' => 'required|string',
            'images' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('images')) {
            // hapus gambar ya kalo ada
            if ($category->images && file_exists(public_path('admin/images/category/' . $category->images))) {
                unlink(public_path('admin/images/category/'. $category->images));
            }

            // upload gambar baru
            $img = $request->file('images');
            $imgname = time() . '-' . uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('admin/images/category/'), $imgname);
            $category->images = $imgname;
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Category updated', 'data' => $category], 200);
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        Storage::disk('public')->delete($category->images);
        $category->delete();

        return response()->json(['message' => 'Category deleted'], 200);
    }
}
