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
    public function index()
    {
        $tag = Tag::all();

        return view('admin.tag.index', compact('tag'));
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
        $request->validate(
            [
            'name' => 'required|unique:tags,name|max:255',
            ],
            [
                'name.required' => 'Please enter Tag data',
                'name.unique' => 'The Tag you entered already exists'
            ]

    );

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);

        $tag->save();
        return redirect()->route('tag.index')
            ->with('success', 'data berhasil ditambahkan');
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
        return redirect()->route('tag.index')
            ->with('success', 'data berhasil di edit');
    }

    public function destroy($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $tag->delete();

        return redirect()->route('tag.index')
            ->with('success', 'data berhasil dihapus');
    }
}
