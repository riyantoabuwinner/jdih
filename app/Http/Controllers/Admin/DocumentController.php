<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Category;
use App\Models\Tag;
use App\Enums\DocumentStatus;
use App\Enums\LegalStatus;
use App\Enums\AccessLevel;
use App\Enums\TerritoryLevel;
use App\Enums\DocumentFunction;
use App\Enums\CategoryType;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

use App\Traits\LogsActivity;

class DocumentController extends Controller
{
    use LogsActivity;

    public function __construct(
        protected DocumentService $documentService
    ) {}

    public function index(Request $request)
    {
        $documents = Document::with(['category', 'creator'])
            ->when($request->search, function($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(15);

        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $clusters = Category::where('type', CategoryType::CLUSTER)->get();
        $categories = Category::where('type', CategoryType::LEGAL_TYPE)->get();
        $subjects = Category::where('type', CategoryType::SUBJECT)->get();
        $territories = Category::where('type', CategoryType::TERRITORY)->get();
        $functions = Category::where('type', CategoryType::FUNCTION)->get();
        
        $tags = Tag::all();
        $allDocuments = Document::select('id', 'title', 'year', 'number')->get();
        
        return view('admin.documents.create', compact('categories', 'subjects', 'territories', 'functions', 'tags', 'allDocuments', 'clusters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'number' => 'nullable|string',
            'year' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'subject_id' => 'nullable|exists:categories,id',
            'abstrak' => 'nullable|string',
            'content_html' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:10485760',
            'tanggal_penetapan' => 'nullable|date',
            'tanggal_pengundangan' => 'nullable|date',
            'status' => ['required', new Enum(DocumentStatus::class)],
            'legal_status' => ['required', new Enum(LegalStatus::class)],
            'access_level' => ['required', new Enum(AccessLevel::class)],
            'territory_level' => ['required', new Enum(TerritoryLevel::class)],
            'document_function' => ['required', new Enum(DocumentFunction::class)],
            'territory_id' => 'required|exists:categories,id',
            'function_id' => 'required|exists:categories,id',
            'relations' => 'nullable|array',
            'relations.*.related_document_id' => 'required|exists:documents,id',
            'relations.*.relation_type' => 'required|string',
        ]);

        $validated['created_by'] = auth()->id();
        
        $status = $validated['status'];
        
        if ($status === DocumentStatus::PUBLISHED) {
            $validated['published_at'] = now();
        }

        $document = $this->documentService->uploadAndCreate($validated, $request->file('file'));

        if ($request->tags) {
            $document->tags()->sync($request->tags);
        }

        if ($request->relations) {
            foreach ($request->relations as $rel) {
                // Ignore if relating to itself or empty
                if (!empty($rel['related_document_id']) && $rel['related_document_id'] != $document->id) {
                    $document->relations()->create([
                        'related_document_id' => $rel['related_document_id'],
                        'relation_type' => $rel['relation_type'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(Document $document)
    {
        $categories = Category::where('type', CategoryType::LEGAL_TYPE)->get();
        $subjects = Category::where('type', CategoryType::SUBJECT)->get();
        $territories = Category::where('type', CategoryType::TERRITORY)->get();
        $functions = Category::where('type', CategoryType::FUNCTION)->get();

        $tags = Tag::all();
        $allDocuments = Document::select('id', 'title', 'year', 'number')
            ->where('id', '!=', $document->id)
            ->get();
            
        return view('admin.documents.edit', compact('document', 'categories', 'subjects', 'territories', 'functions', 'tags', 'allDocuments'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'number' => 'nullable|string',
            'year' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'subject_id' => 'nullable|exists:categories,id',
            'abstrak' => 'nullable|string',
            'content_html' => 'nullable|string',
            'tanggal_penetapan' => 'nullable|date',
            'tanggal_pengundangan' => 'nullable|date',
            'status' => ['required', new Enum(DocumentStatus::class)],
            'legal_status' => ['required', new Enum(LegalStatus::class)],
            'access_level' => ['required', new Enum(AccessLevel::class)],
            'territory_level' => ['required', new Enum(TerritoryLevel::class)],
            'document_function' => ['required', new Enum(DocumentFunction::class)],
            'territory_id' => 'required|exists:categories,id',
            'function_id' => 'required|exists:categories,id',
            'relations' => 'nullable|array',
            'relations.*.related_document_id' => 'required|exists:documents,id',
            'relations.*.relation_type' => 'required|string',
        ]);

        $status = $validated['status'];

        if ($status === DocumentStatus::PUBLISHED && !$document->published_at) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents', 'public');
            $validated['file_path'] = $path;
        }

        $document->update($validated);

        if ($request->tags) {
            $document->tags()->sync($request->tags);
        }

        // Re-sync relations
        $document->relations()->delete();
        if ($request->relations) {
            foreach ($request->relations as $rel) {
                if (!empty($rel['related_document_id']) && $rel['related_document_id'] != $document->id) {
                    $document->relations()->create([
                        'related_document_id' => $rel['related_document_id'],
                        'relation_type' => $rel['relation_type'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diupdate.');
    }

    public function updateStatus(Request $request, Document $document)
    {
        $request->validate(['status' => 'required|string']);
        
        try {
            $status = DocumentStatus::from($request->status);
            $this->documentService->transitionTo($document, $status);
            return back()->with('success', 'Status dokumen berhasil diubah menjadi ' . $status->label());
        } catch (\Exception $e) {
            return back()->with('error', 'Status tidak valid.');
        }
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('admin.documents.index');
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:documents,id'
        ]);

        Document::whereIn('id', $request->ids)->delete();
        
        $this->logActivity('Bulk Deleted documents', null, ['count' => count($request->ids)]);

        return redirect()->route('admin.documents.index')->with('success', count($request->ids) . ' Dokumen produk hukum berhasil dihapus.');
    }
}
