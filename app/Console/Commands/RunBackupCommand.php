<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Exception;
use Log;

class RunBackupCommand extends Command
{
    protected $signature = 'backup:run';
    protected $description = 'Run system backup in background';

    private function updateProgress($percentage)
    {
        Setting::updateOrCreate(
            ['key' => 'backup_progress', 'group' => 'backup'],
            ['value' => (int)$percentage]
        );
    }

    public function handle()
    {
        Setting::updateOrCreate(
            ['key' => 'backup_status', 'group' => 'backup'],
            ['value' => 'processing']
        );
        $this->updateProgress(5);

        try {
            $timestamp = now()->format('Y-m-d_H-i-s');
            $backupName = "backup_{$timestamp}.zip";
            
            if (!Storage::disk('local')->exists('backups')) {
                Storage::disk('local')->makeDirectory('backups');
            }
            
            $zipPath = Storage::disk('local')->path("backups/{$backupName}");

            $zip = new ZipArchive();
            if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                // 1. Export Database
                $this->updateProgress(10);
                
                $dbConnection = config('database.default');
                
                if ($dbConnection === 'sqlite') {
                    $dbPath = config('database.connections.sqlite.database');
                    if (file_exists($dbPath)) {
                        $zip->addFile($dbPath, 'database.sqlite');
                        $this->updateProgress(30);
                    } else {
                        throw new Exception("File basis data SQLite tidak ditemukan di " . $dbPath);
                    }
                } else {
                    $sqlFile = Storage::disk('local')->path("backups/db_temp_{$timestamp}.sql");
                    $this->exportDatabaseMySQL($sqlFile);
                    if (file_exists($sqlFile)) {
                        $zip->addFile($sqlFile, 'database.sql');
                    }
                    $this->updateProgress(30);
                }

                // 2. Zip Storage Public Folder
                $publicPath = storage_path('app/public');
                if (file_exists($publicPath)) {
                    $this->updateProgress(35);
                    
                    // Using Laravel File facade for stable file iteration
                    $allFiles = File::allFiles($publicPath);
                    $totalFiles = count($allFiles);
                    
                    if ($totalFiles > 0) {
                        foreach ($allFiles as $index => $file) {
                            $filePath = $file->getRealPath();
                            $relativePath = 'uploads/' . str_replace('\\', '/', $file->getRelativePathname());
                            $zip->addFile($filePath, $relativePath);
                            
                            // Visual speed control for progress bar (1 second for perfect visibility)
                            usleep(1000000); 
                            
                            $percentage = 35 + ((($index + 1) / $totalFiles) * 60);
                            $this->updateProgress($percentage);
                        }
                    } else {
                        $this->updateProgress(95);
                    }
                }

                $zip->close();
                
                if ($dbConnection !== 'sqlite') {
                    $sqlFile = Storage::disk('local')->path("backups/db_temp_{$timestamp}.sql");
                    if (file_exists($sqlFile)) unlink($sqlFile);
                }

                $this->updateProgress(100);
                Setting::updateOrCreate(
                    ['key' => 'backup_status', 'group' => 'backup'],
                    ['value' => 'ready']
                );
                Setting::updateOrCreate(
                    ['key' => 'last_backup_at', 'group' => 'backup'],
                    ['value' => now()->toDateTimeString()]
                );
            }
        } catch (Exception $e) {
            Log::error("Backup Command Error: " . $e->getMessage());
            Setting::updateOrCreate(['key' => 'backup_status', 'group' => 'backup'], ['value' => 'failed']);
            Setting::updateOrCreate(['key' => 'backup_last_error', 'group' => 'backup'], ['value' => $e->getMessage()]);
            $this->updateProgress(0);
        }
    }

    private function exportDatabaseMySQL($path)
    {
        $tables = DB::select('SHOW TABLES');
        $totalTables = count($tables);
        $sql = "-- JDIH Backup SQL (MySQL)\n-- Date: " . now() . "\n\nSET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $index => $table) {
            $tableVars = get_object_vars($table);
            $tableName = reset($tableVars);
            $create = DB::select("SHOW CREATE TABLE `{$tableName}`")[0];
            $createVars = get_object_vars($create);
            $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n" . $createVars['Create Table'] . ";\n\n";

            $rows = DB::table($tableName)->get();
            foreach ($rows as $row) {
                $rowVars = (array)$row;
                $values = array_map(fn($v) => is_null($v) ? "NULL" : "'" . addslashes($v) . "'", $rowVars);
                $sql .= "INSERT INTO `{$tableName}` VALUES (" . implode(", ", $values) . ");\n";
            }
            $sql .= "\n";
            $this->updateProgress(10 + (($index + 1) / $totalTables * 20));
        }
        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";
        file_put_contents($path, $sql);
    }
}
