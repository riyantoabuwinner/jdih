<?php

namespace App\Repositories\Eloquent;

use App\Models\Document;
use App\Repositories\Interfaces\DocumentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function getAllPaginated(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $query = Document::query()->with(['category', 'tags', 'subject']);

        if (isset($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        }

        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (isset($filters['subject_id'])) {
            $query->where('subject_id', $filters['subject_id']);
        }

        if (isset($filters['territory_level'])) {
            $query->where('territory_level', $filters['territory_level']);
        }

        if (isset($filters['year'])) {
            $query->where('year', $filters['year']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->paginate($perPage);
    }

    public function findById(int $id): ?Document
    {
        return Document::with(['category', 'tags', 'relations.relatedDocument'])->find($id);
    }

    public function findBySlug(string $slug): ?Document
    {
        return Document::with(['category', 'tags', 'relations.relatedDocument'])->where('slug', $slug)->first();
    }

    public function create(array $data): Document
    {
        return Document::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $document = Document::findOrFail($id);
        return $document->update($data);
    }

    public function delete(int $id): bool
    {
        $document = Document::findOrFail($id);
        return $document->delete();
    }

    public function getLatest(int $limit = 5): Collection
    {
        return Document::where('status', 'published')->latest()->take($limit)->get();
    }

    public function getPopular(int $limit = 5): Collection
    {
        return Document::where('status', 'published')->orderBy('view_count', 'desc')->take($limit)->get();
    }
}
