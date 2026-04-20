<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class JdihnController extends Controller
{
    /**
     * JDIHN API Implementation
     * Based on BPHN Standard Metadata
     */
    public function index(Request $request)
    {
        $documents = Document::with(['category', 'subject'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate($request->get('limit', 50));

        $formatted = $documents->getCollection()->map(function ($doc) {
            return [
                'id_jdihn' => (string) $doc->id,
                'judul' => $doc->title,
                'teu' => 'UIN Siber Syekh Nurjati Cirebon',
                'nomor_peraturan' => $doc->number,
                'jenis_peraturan' => $doc->category->name ?? '-',
                'tahun_peraturan' => $doc->year,
                'tanggal_penetapan' => $doc->published_at ? $doc->published_at->format('Y-m-d') : null,
                'tanggal_pengundangan' => $doc->created_at->format('Y-m-d'),
                'sumber' => 'Portal JDIH UIN SSC',
                'status' => $doc->is_active ? 'Berlaku' : 'Tidak Berlaku',
                'bidang_hukum' => $doc->subject->name ?? 'Lain-lain',
                'bahasa' => 'Indonesia',
                'lokasi' => 'Cirebon',
                'url_download' => $doc->file_path ? asset('storage/' . $doc->file_path) : null,
                'url_detail' => route('public.documents.show', $doc->slug),
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'JDIHN Data Provider for UIN SSC',
            'data' => $formatted,
            'pagination' => [
                'total' => $documents->total(),
                'count' => $documents->count(),
                'per_page' => $documents->perPage(),
                'current_page' => $documents->currentPage(),
                'total_pages' => $documents->lastPage(),
            ]
        ]);
    }
}
