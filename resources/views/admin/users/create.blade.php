@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="mb-10">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-slate-900 transition-colors mb-4">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        <span>Kembali ke Daftar</span>
    </a>
    <h2 class="text-3xl font-black text-slate-900">Tambah Administrator</h2>
    <p class="text-slate-500">Daftarkan pengelola sistem JDIH baru.</p>
</div>

<div class="max-w-2xl bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Nama Lengkap</label>
            <input type="text" name="name" required class="w-full px-5 py-3 bg-slate-50 border-slate-200 rounded-xl focus:ring-0 focus:border-[#0F9D58]">
        </div>

        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Email Address</label>
            <input type="email" name="email" required class="w-full px-5 py-3 bg-slate-50 border-slate-200 rounded-xl focus:ring-0 focus:border-[#0F9D58]">
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-5 py-3 bg-slate-50 border-slate-200 rounded-xl focus:ring-0 focus:border-[#0F9D58]">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Role Akses</label>
                <select name="role_id" class="w-full px-5 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-0 focus:border-[#0F9D58]">
                    <option value="1">Super Admin</option>
                    <option value="2">Operator</option>
                </select>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" 
                    class="px-8 py-3 bg-slate-900 text-white rounded-xl font-bold hover:bg-slate-800 transition-all shadow-lg">
                Daftarkan User
            </button>
        </div>
    </form>
</div>
@endsection
