<?php

namespace App\Actions;

use App\Models\Document;
use App\Services\DocumentService;

class CreateDocumentAction
{
    public function __construct(
        protected DocumentService $documentService
    ) {}

    public function execute(array $data, $file = null): Document
    {
        return $this->documentService->uploadAndCreate($data, $file);
    }
}
