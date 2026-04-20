<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\NewsCategory;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $news = News::with('category')->latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = NewsCategory::all();
        $tags = Tag::all();
        return view('admin.news.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
            'news_category_id' => 'nullable|exists:news_categories,id',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request) {
            $data = $request->only(['title', 'slug', 'content', 'status', 'news_category_id', 'published_at']);
            $data['created_by'] = auth()->id();
            
            $data['metadata'] = [
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'seo_keywords' => $request->seo_keywords,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('news', 'public');
            }
            
            $news = News::create($data);

            if ($request->has('tags')) {
                $news->tags()->sync($request->tags);
            }
            
            $this->logActivity('Created News', $news);

            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dipublikasikan.');
        });
    }

    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        $tags = Tag::all();
        return view('admin.news.edit', compact('news', 'categories', 'tags'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug,' . $news->id,
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
            'news_category_id' => 'nullable|exists:news_categories,id',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request, $news) {
            $data = $request->only(['title', 'slug', 'content', 'status', 'news_category_id', 'published_at']);
            
            $data['metadata'] = [
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'seo_keywords' => $request->seo_keywords,
            ];

            if ($request->hasFile('image')) {
                if ($news->image) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($news->image);
                }
                $data['image'] = $request->file('image')->store('news', 'public');
            }
            
            $news->update($data);

            $news->tags()->sync($request->tags ?? []);
            
            $this->logActivity('Updated News', $news);

            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
        });
    }

    public function destroy(News $news)
    {
        $this->logActivity('Deleted News', $news);
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('admin.news.index');
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:news,id'
        ]);

        News::whereIn('id', $request->ids)->delete();
        
        $this->logActivity('Bulk Deleted news', null, ['count' => count($request->ids)]);

        return redirect()->route('admin.news.index')->with('success', count($request->ids) . ' Berita berhasil dihapus.');
    }
}
