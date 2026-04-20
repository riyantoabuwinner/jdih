<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::withCount('news')->latest()->get();
        return view('admin.news_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.news_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:news_categories,name',
            'description' => 'nullable|string',
        ]);

        NewsCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.news-categories.index')->with('success', 'Kategori berita berhasil dibuat.');
    }

    public function edit(NewsCategory $newsCategory)
    {
        return view('admin.news_categories.edit', compact('newsCategory'));
    }

    public function update(Request $request, NewsCategory $newsCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:news_categories,name,' . $newsCategory->id,
            'description' => 'nullable|string',
        ]);

        $newsCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.news-categories.index')->with('success', 'Kategori berita berhasil diperbarui.');
    }

    public function destroy(NewsCategory $newsCategory)
    {
        if ($newsCategory->news()->count() > 0) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus kategori yang masih memiliki berita.');
        }

        $newsCategory->delete();
        return redirect()->route('admin.news-categories.index')->with('success', 'Kategori berita berhasil dihapus.');
    }
}
