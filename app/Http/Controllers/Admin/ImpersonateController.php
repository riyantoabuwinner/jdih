<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImpersonateController extends Controller
{
    public function impersonate($userId)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $userToImpersonate = \App\Models\User::findOrFail($userId);

        if ($userToImpersonate->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Cannot impersonate another Super Admin');
        }

        session(['impersonator_id' => auth()->id()]);
        \Illuminate\Support\Facades\Auth::login($userToImpersonate);

        return redirect()->route('dashboard')->with('success', 'Sekarang anda sedang melihat tampilan sebagai ' . $userToImpersonate->name);
    }

    public function leave()
    {
        if (!session()->has('impersonator_id')) {
            abort(403);
        }

        $impersonatorId = session()->pull('impersonator_id');
        $impersonator = \App\Models\User::findOrFail($impersonatorId);

        \Illuminate\Support\Facades\Auth::login($impersonator);

        return redirect()->route('admin.users.index')->with('success', 'Kembali ke mode Super Admin');
    }
}
