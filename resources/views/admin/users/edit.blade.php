@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="mb-10">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-slate-900 transition-colors mb-4">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        <span>Kembali ke Daftar</span>
    </a>
    <h2 class="text-3xl font-black text-slate-900">Ubah Akses</h2>
    <p class="text-slate-500">Perbarui profil atau hak akses administrator.</p>
</div>

<div class="max-w-2xl bg-white p-10 rounded-3xl border border-slate-200 shadow-sm">
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl font-bold focus:ring-0 focus:border-[#0F9D58]">
        </div>

        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Email Address</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl focus:ring-0 focus:border-[#0F9D58]">
        </div>

        <div class="grid grid-cols-2 gap-8">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Password Baru (Opsional)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak diganti" class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl focus:ring-0 focus:border-[#0F9D58]">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Level Akses</label>
                <select name="role_id" class="w-full px-5 py-4 bg-slate-50 border-slate-200 rounded-2xl text-sm font-bold focus:ring-0 focus:border-[#0F9D58]">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="pt-6">
            <button type="submit" 
                    style="background-color: #0c1120; color: white;"
                    class="w-full py-4 rounded-2xl font-bold hover:opacity-90 transition-all shadow-xl shadow-slate-900/10">
                Simpan Perubahan User
            </button>
        </div>
    </form>
</div>
@endsection
