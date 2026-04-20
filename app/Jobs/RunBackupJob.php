<?php

namespace App\Jobs;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use Exception;
use Log;

class RunBackupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600;

    public function __construct()
    {
        //
    }

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
            
            $zipPath = storage_path("app/backups/{$backupName}");

            $zip = new ZipArchive();
            if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                // 1. Export Database
                $this->updateProgress(10);
                $sqlFile = storage_path("app/backups/db_temp_{$timestamp}.sql");
                $this->exportDatabase($sqlFile); // This will update progress within itself too
                
                if (file_exists($sqlFile)) {
                    $zip->addFile($sqlFile, 'database.sql');
                }
                $this->updateProgress(30);

                // 2. Zip Storage Public Folder
                $publicPath = storage_path('app/public');
                if (file_exists($publicPath)) {
                    $files = new \RecursiveIteratorIterator(
                        new \RecursiveDirectoryIterator($publicPath),
                        \RecursiveIteratorIterator::LEAF_ONLY
                    );

                    $allFiles = iterator_to_array($files);
                    $totalFiles = count($allFiles);
                    $count = 0;

                    foreach ($allFiles as $name => $file) {
                        if (!$file->isDir()) {
                            $filePath = $file->getRealPath();
                            $relativePath = 'uploads/' . substr($filePath, strlen($publicPath) + 1);
                            $zip->addFile($filePath, $relativePath);
                            
                            $count++;
                            if ($count % 10 == 0 || $count == $totalFiles) {
                                $percentage = 30 + (($count / $totalFiles) * 65);
                                $this->updateProgress($percentage);
                            }
                        }
                    }
                }

                $zip->close();
                
                if (file_exists($sqlFile)) {
                    unlink($sqlFile);
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
            } else {
                throw new Exception("Gagal membuka file ZIP untuk penulisan.");
            }
        } catch (Exception $e) {
            Log::error("Backup Job Error: " . $e->getMessage());
            Setting::updateOrCreate(
                ['key' => 'backup_status', 'group' => 'backup'],
                ['value' => 'failed']
            );
            Setting::updateOrCreate(
                ['key' => 'backup_last_error', 'group' => 'backup'],
                ['value' => $e->getMessage()]
            );
            $this->updateProgress(0);
        }
    }

    private function exportDatabase($path)
    {
        $tables = DB::select('SHOW TABLES');
        $totalTables = count($tables);
        $sql = "-- JDIH Backup SQL\n-- Date: " . now() . "\n\nSET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $index => $table) {
            $tableVars = get_object_vars($table);
            $tableName = reset($tableVars);
            
            $create = DB::select("SHOW CREATE TABLE `{$tableName}`")[0];
            $createVars = get_object_vars($create);
            $createTableSql = $createVars['Create Table'];
            
            $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $sql .= $createTableSql . ";\n\n";

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

            // Update sub-progress between 10% and 30%
            $subProgress = 10 + (($index + 1) / $totalTables * 20);
            $this->updateProgress($subProgress);
        }
        
        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";
        file_put_contents($path, $sql);
    }
}
