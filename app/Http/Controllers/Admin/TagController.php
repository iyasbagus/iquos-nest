<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tags = Tag::all();

        $tagTotal = Tag::count();

        // Jika request datang dari AJAX, kembalikan JSON response
        if ($request->ajax()) {
            return response()->json($tags);
        }

        // Jika bukan AJAX, tampilkan halaman view
        return view('admin.tag.index', compact('tags', 'tagTotal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|array|min:1', // Harus array
        'name.*' => 'required|string|max:255|unique:tags,name',
    ], [
        'name.required' => 'Tag tidak boleh kosong!',
        'name.*.unique' => 'Tag sudah ada!',
    ]);

    $tags = collect($request->name)->map(function ($tagName) {
        return Tag::create([
            'name' => $tagName,
            'slug' => Str::slug($tagName),
        ]);
    });

    return response()->json([
        'message' => 'Tag berhasil ditambahkan!',
        'tags' => $tags
    ]);
}

    public function show(Tag $tag)
    {
        //
    }

    public function edit($slug)
    {
        $tag = Tag::FindOrFail('slug', $slug);
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, $slug)
    {
        $validate = $request->validate([
            'name' => 'required|unique:tags,name,' . $slug . ',slug',
        ]);

        $tag = Tag::FindOrFail('slug', $slug);
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);

        $tag->save();
        return redirect()->route('tag.index')->with('success', 'data berhasil di edit');
    }

    public function destroy($slug)
{
    $tag = Tag::where('slug', $slug)->firstOrFail();
    $tag->delete();

    return response()->json([
        'success' => 'data berhasil dihapus'
    ]);
}
}
