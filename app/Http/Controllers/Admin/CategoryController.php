<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();

        return view('admin.category.index', compact('category'));
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store(Request $request)
    {
         $validate = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'images' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        if ($request->hasFile('images')) {
            $img = $request->file('images');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('admin/images/category/', $name);
            $category->images = $name;
        }

        $category->save();
        return redirect()->route('category.index')
            ->with('success', 'data berhasil ditambahkan');
    }


    public function show($id)
    {
        $category = Category::FindOrFail($id);
        return view('admin.category.show', compact('category'));
    }


    public function edit($id)
    {
        $category = Category::FindOrFail($id);
        return view('admin.category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            // 'gambar_kategori' => 'required',
            'description' => 'required',
        ]);

        $category = Category::FindOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        if ($request->hasFile('images')) {
            $category->deleteImage();
            $img = $request->file('images');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('admin/images/category/', $name);
            $category->images = $name;
        }

        $category->save();
        return redirect()->route('category.index')
            ->with('success', 'data berhasil di edit');
    }


    public function destroy($id)
    {
        $category = Category::FindOrFail($id);
        $category->delete();
        // $siswa->genre()->detach();
        return redirect()->route('category.index')
            ->with('success', 'data berhasil dihapus');
    }
}
