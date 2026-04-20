<?php

namespace App\Repositories\Interfaces;

use App\Models\Document;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface DocumentRepositoryInterface
{
    public function getAllPaginated(int $perPage = 10, array $filters = []): LengthAwarePaginator;
    public function findById(int $id): ?Document;
    public function findBySlug(string $slug): ?Document;
    public function create(array $data): Document;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function getLatest(int $limit = 5): Collection;
    public function getPopular(int $limit = 5): Collection;
}
