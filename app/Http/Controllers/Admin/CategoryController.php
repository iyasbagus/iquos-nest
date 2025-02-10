<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();

        return view('admin.category.index', compact('category'));
    }


    public function create()
    {
        return view();
    }


    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'description' => 'required',
            'images' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;

        if ($request->hasFile('images')) {
            $img = $request->file('images');
            $name = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move('admin/images/category/', $name);
            $category->images = $name;
        }

        $category->save();

        return redirect()->route('category.index')
            ->with('success', 'data berhasil ditambahkan');
    }


    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('admin.category.show', compact('category'));
    }


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

        // if ($request->hasFile('images')) {
        //     $category->deleteImage();
        //     $img = $request->file('images');
        //     $name = rand(1000, 9999) . $img->getClientOriginalName();
        //     $img->move('admin/images/category/', $name);
        //     $category->images = $name;
        // }

        $category->save();
        return redirect()->route('category.index')
            ->with('success', 'data berhasil di edit');
    }


    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        if(!$category) {
            return redirect()->back()->with('error', 'Category Not Found');
        }

        $file_path = public_path('admin/images/category/' . $category->images);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }

        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'data berhasil dihapus');
    }
}
