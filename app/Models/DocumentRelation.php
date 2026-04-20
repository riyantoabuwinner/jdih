<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\RelationType;

class DocumentRelation extends Model
{
    protected $fillable = ['document_id', 'related_document_id', 'relation_type', 'note'];

    protected $casts = [
        'relation_type' => RelationType::class,
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function relatedDocument()
    {
        return $this->belongsTo(Document::class, 'related_document_id');
    }
}
