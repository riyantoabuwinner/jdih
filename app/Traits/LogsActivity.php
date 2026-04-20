<?php

namespace App\Traits;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    public function logActivity($action, $model = null, $payload = null)
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model_type' => ($model && is_object($model)) ? get_class($model) : (is_string($model) ? $model : null),
            'model_id' => ($model && is_object($model)) ? $model->id : null,
            'payload' => $payload,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
