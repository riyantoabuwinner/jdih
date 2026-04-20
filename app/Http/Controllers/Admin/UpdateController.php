<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function index()
    {
        $branch = trim(shell_exec("git rev-parse --abbrev-ref HEAD") ?? 'Unknown');
        $hash = trim(shell_exec("git rev-parse --short HEAD") ?? 'Unknown');
        $date = trim(shell_exec("git log -1 --format=%cd --date=relative") ?? 'Unknown');
        $logs = trim(shell_exec("git log -n 10 --format='%h %s (%cr) <%an>'") ?? 'Belum ada riwayat perubahan.');
        
        return view('admin.updates.index', [
            'branch' => $branch,
            'hash' => $hash,
            'date' => $date,
            'logs' => $logs,
            'last_output' => session('update_log') ?? 'Belum ada output eksekusi terbaru. Silakan tekan tombol "Perbarui Sistem" untuk memulai.'
        ]);
    }

    public function check()
    {
        shell_exec("git fetch origin");
        return redirect()->back()->with('success', 'Berhasil menyinkronkan data dengan repository GitHub.');
    }

    public function update()
    {
        $output = shell_exec("git pull origin main 2>&1");
        
        // Post-update maintenance
        shell_exec("php artisan migrate --force");
        shell_exec("php artisan optimize:clear");
        
        return redirect()->back()->with('success', 'Proses pembaruan sistem selesai.')->with('update_log', $output);
    }
}
