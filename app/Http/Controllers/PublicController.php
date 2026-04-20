<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\DocumentRepositoryInterface;
use App\Models\Category;
use App\Models\News;
use App\Models\FAQ;
use App\Models\Feedback;

class PublicController extends Controller
{
    public function __construct(
        protected DocumentRepositoryInterface $documentRepository
    ) {}

    public function index()
    {
        $latestDocuments = $this->documentRepository->getLatest(5);
        $popularDocuments = $this->documentRepository->getPopular(6);
        $categories = Category::whereNull('parent_id')
                        ->whereIn('type', [
                            \App\Enums\CategoryType::LEGAL_TYPE, 
                            \App\Enums\CategoryType::CLUSTER
                        ])
                        ->withCount('documents')
                        ->get();
        $latestNews = News::where('status', 'published')->latest()->take(3)->get();
        
        // Data for Statistics Section
        $popularCategoriesForChart = Category::where('type', \App\Enums\CategoryType::LEGAL_TYPE)
            ->withCount('documents')
            ->orderBy('documents_count', 'desc')
            ->take(5)
            ->get();

        $visitStats = [
            'total' => \App\Models\Document::sum('view_count'),
            'year' => \App\Models\Log::where('action', 'view')->whereYear('created_at', date('Y'))->count(),
            'month' => \App\Models\Log::where('action', 'view')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count(),
            'today' => \App\Models\Log::where('action', 'view')->whereDate('created_at', date('Y-m-d'))->count(),
            'online' => \App\Models\Log::where('created_at', '>=', now()->subMinutes(15))->distinct('ip_address')->count() + 1,
        ];

        $stats = [
            'total_documents' => \App\Models\Document::count(),
            'total_categories' => \App\Models\Category::count(),
            'total_views' => \App\Models\Document::sum('view_count'),
            'total_downloads' => \App\Models\Document::sum('download_count'),
        ];

        return view('welcome', compact(
            'latestDocuments', 
            'popularDocuments', 
            'categories', 
            'latestNews', 
            'popularCategoriesForChart', 
            'visitStats',
            'stats'
        ));
    }

    public function search(Request $request)
    {
        $filters = $request->only(['search', 'category_id', 'year', 'status', 'subject_id', 'territory_level']);
        $documents = $this->documentRepository->getAllPaginated(12, $filters);
        $categories = Category::where('type', \App\Enums\CategoryType::LEGAL_TYPE)->get();

        return view('public.documents.index', compact('documents', 'categories', 'filters'));
    }

    public function showDocument($slug)
    {
        $document = \App\Models\Document::with(['relations.relatedDocument', 'category', 'subject', 'tags'])->where('slug', $slug)->firstOrFail();
        
        // tracking
        $document->increment('view_count');

        \App\Models\Log::create([
            'action' => 'view',
            'model_type' => \App\Models\Document::class,
            'model_id' => $document->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return view('public.documents.show', compact('document'));
    }

    public function faq()
    {
        $faqs = \App\Models\FAQ::where('is_published', true)->orderBy('order')->get();
        return view('public.faq', compact('faqs'));
    }

    public function feedback()
    {
        return view('public.feedback');
    }

    public function storeFeedback(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        \App\Models\Feedback::create($validated);

        return redirect()->back()->with('success', 'Terima kasih atas masukan Anda!');
    }

    public function showNews($slug)
    {
        // This method can still be used if explicitly linked to /berita/{slug}
        // but the catch-all below will also handle it.
        $news = News::where('slug', $slug)->where('status', 'published')->firstOrFail();
        
        $relatedNews = News::where('id', '!=', $news->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('public.news.show', compact('news', 'relatedNews'));
    }

    public function showPage($slug)
    {
        // Check Page model first
        $page = \App\Models\Page::where('slug', $slug)->first();
        if ($page) {
            return view('public.pages.show', compact('page'));
        }

        // Check News model second
        $news = News::where('slug', $slug)->where('status', 'published')->first();
        if ($news) {
            $relatedNews = News::where('id', '!=', $news->id)
                ->where('status', 'published')
                ->latest()
                ->take(3)
                ->get();
            return view('public.news.show', compact('news', 'relatedNews'));
        }

        abort(404);
    }
    public function newsByCategory($slug)
    {
        $category = \App\Models\NewsCategory::where('slug', $slug)->firstOrFail();
        $news = News::where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(12);
        
        return view('public.news.category', compact('category', 'news'));
    }

    public function viewPdf($slug)
    {
        $document = \App\Models\Document::where('slug', $slug)->firstOrFail();
        $filePath = $document->file_path;

        if (!$filePath || !\Illuminate\Support\Facades\Storage::disk('public')->exists($filePath)) {
            abort(404, 'Berkas fisik tidak ditemukan di server.');
        }

        $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($filePath);
        $fileName = str_replace(['/', '\\', '"', "'"], '-', strip_tags($document->title)) . '.pdf';

        \App\Models\Log::create([
            'action' => 'read',
            'model_type' => \App\Models\Document::class,
            'model_id' => $document->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return response()->file($fullPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

    public function downloadPdf($slug)
    {
        $document = \App\Models\Document::where('slug', $slug)->firstOrFail();
        if (!$document->file_path || !\Illuminate\Support\Facades\Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $document->increment('download_count');
        
        \App\Models\Log::create([
            'action' => 'download',
            'model_type' => \App\Models\Document::class,
            'model_id' => $document->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return \Illuminate\Support\Facades\Storage::disk('public')->download(
            $document->file_path, 
            str_replace(['/', '\\'], '-', strip_tags($document->title)) . '.pdf'
        );
    }
}
