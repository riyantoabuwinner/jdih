<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.pages.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request) {
            $data = $request->only(['title', 'slug', 'content']);
            
            $data['metadata'] = [
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'seo_keywords' => $request->seo_keywords,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('pages', 'public');
            }

            $page = Page::create($data);

            if ($request->has('tags')) {
                $page->tags()->sync($request->tags);
            }

            return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dibuat.');
        });
    }

    public function edit(Page $page)
    {
        $tags = Tag::all();
        return view('admin.pages.edit', compact('page', 'tags'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request, $page) {
            $data = $request->only(['title', 'slug', 'content']);

            $data['metadata'] = [
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'seo_keywords' => $request->seo_keywords,
            ];

            if ($request->hasFile('image')) {
                if ($page->image) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($page->image);
                }
                $data['image'] = $request->file('image')->store('pages', 'public');
            }

            $page->update($data);

            $page->tags()->sync($request->tags ?? []);

            return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diperbarui.');
        });
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('admin.pages.index');
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:pages,id'
        ]);

        Page::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.pages.index')->with('success', count($request->ids) . ' Halaman berhasil dihapus.');
    }
}
