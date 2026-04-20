@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-3xl font-black text-slate-900">Akses Pengguna</h2>
        <p class="text-slate-500">Kelola admin dan operator sistem JDIH.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-slate-900 text-white rounded-xl font-bold flex items-center gap-2 hover:scale-105 transition-all shadow-lg">
            <i data-lucide="user-plus" class="w-5 h-5"></i>
            Tambah Admin
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Nama / Email</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Role</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Status</th>
                <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($users as $user)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold uppercase">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 leading-none">{{ $user->name }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black uppercase tracking-widest">
                            {{ $user->role->name ?? 'Admin' }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-2 text-green-600">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-[10px] font-black uppercase tracking-widest">Active</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                         <div class="flex items-center justify-end gap-3">
                            @if(auth()->user()->isSuperAdmin() && !$user->isSuperAdmin())
                                <form action="{{ route('admin.impersonate.start', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 px-3 py-1.5 bg-orange-50 text-orange-600 border border-orange-100 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-orange-600 hover:text-white transition-all shadow-sm" title="Impersonate {{ $user->name }}">
                                        <i data-lucide="user-check" class="w-3.5 h-3.5"></i>
                                        Impersonate
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-slate-400 hover:text-islami transition-colors"><i data-lucide="edit-3" class="w-4 h-4"></i></a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Cabut akses user ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </form>
                         </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
