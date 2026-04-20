<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request as LegalRequest;

class RequestController extends Controller
{
    public function index() {
        $requests = LegalRequest::latest()->paginate(20);
        return view('admin.requests.index', compact('requests'));
    }
}
