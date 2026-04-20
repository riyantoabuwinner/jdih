<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\DocumentStatus;
use App\Enums\LegalStatus;
use App\Enums\AccessLevel;
use App\Enums\TerritoryLevel;
use App\Enums\DocumentFunction;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Document extends Model
{
    use SoftDeletes, Searchable;

    protected $fillable = [
        'title', 'slug', 'number', 'year', 'category_id', 'subject_id', 
        'territory_id', 'function_id',
        'status', 'legal_status', 'access_level', 'territory_level', 'document_function',
        'abstrak', 'content_html', 'file_path', 'tanggal_penetapan', 'tanggal_pengundangan',
        'created_by', 'published_at', 'view_count', 'download_count', 'metadata'
    ];

    protected $casts = [
        'status' => DocumentStatus::class,
        'legal_status' => LegalStatus::class,
        'access_level' => AccessLevel::class,
        'territory_level' => TerritoryLevel::class,
        'document_function' => DocumentFunction::class,
        'tanggal_penetapan' => 'date',
        'tanggal_pengundangan' => 'date',
        'published_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subject()
    {
        return $this->belongsTo(Category::class, 'subject_id');
    }

    public function territory()
    {
        return $this->belongsTo(Category::class, 'territory_id');
    }

    public function legalFunction()
    {
        return $this->belongsTo(Category::class, 'function_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function relations()
    {
        return $this->hasMany(DocumentRelation::class, 'document_id');
    }

    public function relatedBy()
    {
        return $this->hasMany(DocumentRelation::class, 'related_document_id');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'number' => $this->number,
            'year' => (int) $this->year,
            'category' => $this->category->name,
            'abstract' => $this->abstract,
            'status' => $this->status->value,
            'tags' => $this->tags->pluck('name')->toArray(),
            // For semantic search (vector search), you would include embeddings here
            // '_vectors' => $this->getEmbeddings(), 
        ];
    }
}
