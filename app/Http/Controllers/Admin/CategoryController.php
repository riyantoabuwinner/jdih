<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\LogsActivity;
use App\Enums\CategoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

class CategoryController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $categories = Category::with(['children', 'parent', 'categories'])
            ->withCount([
                'documents', 
                'documentsAsSubject', 
                'documentsAsTerritory', 
                'documentsAsFunction'
            ])
            ->orderBy('type')
            ->orderBy('name')
            ->get();
            
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::whereIn('type', [CategoryType::CLUSTER, CategoryType::LEGAL_TYPE])->get();
        $subjects = Category::where('type', CategoryType::SUBJECT)->get();
        $territories = Category::where('type', CategoryType::TERRITORY)->get();
        $functions = Category::where('type', CategoryType::FUNCTION)->get();
        
        return view('admin.categories.create', compact('parents', 'subjects', 'territories', 'functions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'type' => [new Enum(CategoryType::class)],
            'mapping_ids' => 'nullable|array',
            'mapping_ids.*' => 'exists:categories,id'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['order'] = $validated['order'] ?? 0;
        
        $category = Category::create($validated);
        
        if ($request->has('mapping_ids')) {
            $category->categories()->sync($request->mapping_ids);
        }
        
        $this->logActivity('Created Category with Mapping', $category);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori & Pemetaan berhasil dibuat.');
    }

    public function edit(Category $category)
    {
        $parents = Category::where('id', '!=', $category->id)->get();
        $subjects = Category::where('type', CategoryType::SUBJECT)->get();
        $territories = Category::where('type', CategoryType::TERRITORY)->get();
        $functions = Category::where('type', CategoryType::FUNCTION)->get();
        
        $currentMappings = $category->categories->pluck('id')->toArray();
        
        return view('admin.categories.edit', compact('category', 'parents', 'subjects', 'territories', 'functions', 'currentMappings'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'type' => [new Enum(CategoryType::class)],
            'mapping_ids' => 'nullable|array',
            'mapping_ids.*' => 'exists:categories,id'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['order'] = $validated['order'] ?? 0;
        
        $category->update($validated);
        
        if ($request->has('mapping_ids')) {
            $category->categories()->sync($request->mapping_ids);
        } else {
            $category->categories()->detach();
        }
        
        $this->logActivity('Updated Category & Mapping', $category);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori & Pemetaan berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $this->logActivity('Deleted Category', $category);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
