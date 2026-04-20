<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use ZipArchive;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    public function index()
    {
        // Get list of physical backup files
        if (!Storage::disk('local')->exists('backups')) {
            Storage::disk('local')->makeDirectory('backups');
        }

        $files = Storage::disk('local')->files('backups');
        $backups = collect($files)->map(function ($file) {
            return [
                'name' => basename($file),
                'size' => round(Storage::disk('local')->size($file) / 1024 / 1024, 2) . ' MB',
                'created_at' => Carbon::createFromTimestamp(Storage::disk('local')->lastModified($file)),
                'path' => $file
            ];
        })->sortByDesc('created_at');

        $settings = Setting::where('group', 'backup')->pluck('value', 'key');

        return view('admin.backups.index', compact('backups', 'settings'));
    }

    public function runManual()
    {
        \Log::info('Manual backup triggered at ' . now());
        if (!class_exists('ZipArchive')) {
            return redirect()->back()->with('error', 'Ekstensi PHP ZipArchive tidak aktif. Silakan aktifkan di php.ini.');
        }

        $currentStatus = Setting::where('key', 'backup_status')->where('group', 'backup')->first();
        if ($currentStatus && $currentStatus->value === 'processing') {
            return redirect()->back()->with('error', 'Proses backup sedang berjalan.');
        }

        Setting::updateOrCreate(['key' => 'backup_status', 'group' => 'backup'], ['value' => 'processing']);
        Setting::updateOrCreate(['key' => 'backup_progress', 'group' => 'backup'], ['value' => 0]);

        $artisan = base_path('artisan');

        // Trick for XAMPP/PHP-FPM: Finish request and continue in background
        if (function_exists('fastcgi_finish_request')) {
            session()->flash('success', 'Backup sedang diproses...');
            session()->save();
            
            // Send headers to redirect immediately
            header("Location: " . route('admin.backups.index'));
            header("Content-Length: 0");
            header("Connection: close");
            fastcgi_finish_request();

            // Continue execution
            try {
                \Illuminate\Support\Facades\Artisan::call('backup:run');
            } catch (\Exception $e) {
                \Log::error("Backup FinishRequest Error: " . $e->getMessage());
            }
            return;
        }

        // Fallback for standard CGI/CLI
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            pclose(popen("START /B php \"$artisan\" backup:run > nul 2>&1", "r"));
        } else {
            exec("php \"$artisan\" backup:run > /dev/null 2>&1 &");
        }

        return redirect()->back()->with('success', 'Manual backup telah dimulai.');
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'backup_frequency' => 'required|in:daily,weekly,monthly,none',
            'backup_retention' => 'required|integer|min:1',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key, 'group' => 'backup'],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Pengaturan backup berhasil diperbarui.');
    }

    public function download($file)
    {
        $path = "backups/{$file}";
        if (Storage::disk('local')->exists($path)) {
            return Storage::disk('local')->download($path);
        }
        abort(404);
    }

    public function destroy($file)
    {
        $path = "backups/{$file}";
        if (Storage::disk('local')->exists($path)) {
            Storage::disk('local')->delete($path);
            return redirect()->back()->with('success', 'File backup berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    private function exportDatabase($path)
    {
        $tables = DB::select('SHOW TABLES');
        $sql = "-- JDIH Backup SQL\n-- Date: " . now() . "\n\nSET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            // Get the first property value which is the table name
            $tableVars = get_object_vars($table);
            $tableName = reset($tableVars);
            
            // Create Table
            $create = DB::select("SHOW CREATE TABLE `{$tableName}`")[0];
            $createVars = get_object_vars($create);
            $createTableSql = $createVars['Create Table'];
            
            $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $sql .= $createTableSql . ";\n\n";

            // Data
            $rows = DB::table($tableName)->get();
            foreach ($rows as $row) {
                $rowVars = (array)$row;
                $values = array_map(function($val) {
                    if (is_null($val)) return "NULL";
                    return "'" . addslashes($val) . "'";
                }, $rowVars);
                
                $sql .= "INSERT INTO `{$tableName}` VALUES (" . implode(", ", $values) . ");\n";
            }
            $sql .= "\n";
        }
        
        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";
        file_put_contents($path, $sql);
    }
}
