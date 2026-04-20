<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() { $users = User::with('role')->paginate(10); return view('admin.users.index', compact('users')); }
    
    public function create() { $roles = Role::all(); return view('admin.users.create', compact('roles')); }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id'
        ]);
        
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id']
        ]);
        
        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }
    
    public function edit(User $user) { 
        $roles = Role::all(); 
        return view('admin.users.edit', compact('user', 'roles')); 
    }
    
    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role_id' => 'required|exists:roles,id'
        ]);
        
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id']
        ];
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'Akses pengguna berhasil diperbarui.');
    }

    public function destroy(User $user) {
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Akses pengguna telah dicabut.');
    }
}
