<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $totalDocuments = Document::count();
        $totalCategories = Category::count();
        $totalFeedbacks = Feedback::count();

        // Documents by Status
        $docsByStatus = Document::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Generate date range for the last 30 days starting from today
        $dates = collect();
        for ($i = 29; $i >= 0; $i--) {
            $dates->put(now()->subDays($i)->format('Y-m-d'), 0);
        }

        // Daily Uploaded Documents (using created_at to be up-to-date with uploads)
        $uploadedData = Document::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', now()->subDays(30)->startOfDay())
            ->groupBy('date')
            ->pluck('total', 'date');

        $dailyPublished = $dates->map(function ($value, $date) use ($uploadedData) {
            return [
                'date' => $date,
                'total' => $uploadedData->get($date, 0)
            ];
        })->values();

        // Daily Visitor Activity
        $visitData = \App\Models\Log::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->whereIn('action', ['view', 'read', 'download', 'show'])
            ->where('model_type', \App\Models\Document::class)
            ->where('created_at', '>=', now()->subDays(30)->startOfDay())
            ->groupBy('date')
            ->pluck('total', 'date');

        $dailyVisits = $dates->map(function ($value, $date) use ($visitData) {
            return [
                'date' => $date,
                'total' => $visitData->get($date, 0)
            ];
        })->values();

        // Totals (Synchronized with Public Infographics)
        $totalPublishedCount = Document::count();
        $totalVisitsCount = Document::sum('view_count') + Document::sum('download_count');

        // Survey Rating Distribution
        $surveyStats = Feedback::select('rating', DB::raw('count(*) as total'))
            ->groupBy('rating')
            ->orderBy('rating', 'asc')
            ->pluck('total', 'rating');

        return view('admin.reports.index', compact(
            'totalDocuments', 
            'totalCategories', 
            'totalFeedbacks',
            'docsByStatus',
            'dailyPublished',
            'dailyVisits',
            'totalPublishedCount',
            'totalVisitsCount',
            'surveyStats'
        ));
    }

    public function documents()
    {
        // Yearly distribution
        $yearlyStats = Document::select(DB::raw('year as doc_year'), DB::raw('count(*) as total'))
            ->groupBy('doc_year')
            ->orderBy('doc_year', 'desc')
            ->get();

        // Type distribution
        $typeStats = Document::with('category')->get()
            ->groupBy('category.name')
            ->map(function ($items) {
                return count($items);
            });

        return view('admin.reports.documents', compact('yearlyStats', 'typeStats'));
    }
}
