<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationCluster extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'icon', 'order'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
