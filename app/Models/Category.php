<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\CategoryType;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id', 'description', 'order', 'type'];

    protected $casts = [
        'type' => CategoryType::class,
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function documentsAsSubject()
    {
        return $this->hasMany(Document::class, 'subject_id');
    }

    public function documentsAsTerritory()
    {
        return $this->hasMany(Document::class, 'territory_id');
    }

    public function documentsAsFunction()
    {
        return $this->hasMany(Document::class, 'function_id');
    }

    /**
     * Get total document count including children (for Clusters)
     */
    public function getTotalDocumentsCountAttribute()
    {
        // If it's a Cluster, sum up counts from all its Legal Type children (and their children)
        if ($this->type === CategoryType::CLUSTER) {
            $childIds = $this->getAllChildIds();
            return Document::whereIn('category_id', $childIds)->count();
        }

        // For other types, return their direct count based on the relationship
        return match($this->type) {
            CategoryType::LEGAL_TYPE => $this->documents()->count(),
            CategoryType::SUBJECT => $this->documentsAsSubject()->count(),
            CategoryType::TERRITORY => $this->documentsAsTerritory()->count(),
            CategoryType::FUNCTION => $this->documentsAsFunction()->count(),
            default => 0
        };
    }

    private function getAllChildIds()
    {
        $ids = [];
        foreach ($this->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->getAllChildIds());
        }
        return $ids;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_relations', 'source_category_id', 'target_category_id');
    }

    public function allowedSubjects()
    {
        return $this->categories()->where('type', CategoryType::SUBJECT);
    }

    public function allowedTerritories()
    {
        return $this->categories()->where('type', CategoryType::TERRITORY);
    }

    public function allowedFunctions()
    {
        return $this->categories()->where('type', CategoryType::FUNCTION);
    }
}
