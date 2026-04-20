<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index() 
    { 
        $tags = Tag::withCount(['documents', 'pages', 'news'])->latest()->get(); 
        return view('admin.tags.index', compact('tags')); 
    }
    public function store(Request $request) {
        $validated = $request->validate(['name' => 'required|unique:tags']);
        Tag::create(['name' => $validated['name'], 'slug' => Str::slug($validated['name'])]);
        return back()->with('success', 'Tag created.');
    }
    public function destroy(Tag $tag) { $tag->delete(); return back()->with('success', 'Tag deleted.'); }
}
