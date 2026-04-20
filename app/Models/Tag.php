<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }

    public function news()
    {
        return $this->belongsToMany(News::class);
    }
}
