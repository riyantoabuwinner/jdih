<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['ticket_number', 'category', 'name', 'email', 'phone', 'message', 'status', 'response', 'responded_at'];

    protected $casts = [
        'responded_at' => 'datetime',
    ];
}
