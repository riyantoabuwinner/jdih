<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;

class LogController extends Controller
{
    public function index() {
        $logs = Log::with('user')->latest()->paginate(50);
        return view('admin.logs.index', compact('logs'));
    }
}
