<?php

namespace App\Services;

use App\Enums\DocumentStatus;
use App\Models\Document;
use App\Repositories\Interfaces\DocumentRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentService
{
    public function __construct(
        protected DocumentRepositoryInterface $documentRepository
    ) {}

    public function uploadAndCreate(array $data, $file = null): Document
    {
        if ($file) {
            $path = $file->store('documents', 'public');
            $data['file_path'] = $path;
        }

        $data['slug'] = Str::slug(strip_tags($data['title'])) . '-' . rand(1000, 9999);
        
        if (!isset($data['status'])) {
            $data['status'] = DocumentStatus::DRAFT;
        }
        
        return $this->documentRepository->create($data);
    }

    public function transitionTo(Document $document, DocumentStatus $status): bool
    {
        // Simple workflow logic
        if ($status === DocumentStatus::PUBLISHED && !$document->published_at) {
            $document->published_at = now();
        }

        return $document->update(['status' => $status]);
    }

    public function incrementView(Document $document): void
    {
        $document->increment('view_count');
    }
}
