<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function documents(Request $request)
    {
        $docs = Document::with('category')->where('status', 'published')
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->latest()
            ->paginate(20);
            
        return response()->json($docs);
    }

    public function document($id)
    {
        $doc = Document::with(['category', 'tags', 'relations.relatedDocument'])->findOrFail($id);
        
        \App\Models\Log::create([
            'action' => 'view',
            'model_type' => \App\Models\Document::class,
            'model_id' => $doc->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return response()->json($doc);
    }

    public function categories()
    {
        return response()->json(Category::all());
    }

    public function news()
    {
        return response()->json(News::where('status', 'published')->latest()->paginate(10));
    }

    public function search(Request $request)
    {
        // Using Scout for search
        $query = $request->get('q');
        if (!$query) return response()->json([]);

        $results = Document::search($query)->paginate(20);
        return response()->json($results);
    }
}
