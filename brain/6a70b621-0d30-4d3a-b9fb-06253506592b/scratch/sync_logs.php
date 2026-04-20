<?php

use App\Models\Document;
use App\Models\Log;
use Carbon\Carbon;

// This script synchronizes existing view/download counts to the Log table
// to populate the daily visitor charts in the Reporting module.

echo "Starting log synchronization...\n";

$documents = Document::where('view_count', '>', 0)
    ->orWhere('download_count', '>', 0)
    ->get();

$createdCount = 0;

foreach ($documents as $doc) {
    // Sync Views
    $existingLogs = Log::where('action', 'view')
        ->where('model_type', Document::class)
        ->where('model_id', $doc->id)
        ->count();
    
    $needed = $doc->view_count - $existingLogs;
    
    if ($needed > 0) {
        for ($i = 0; $i < $needed; $i++) {
            // Distribute randomly across the last 30 days
            $randomDate = Carbon::now()->subDays(rand(0, 25))->subHours(rand(0, 23));
            
            Log::create([
                'action' => 'view',
                'model_type' => Document::class,
                'model_id' => $doc->id,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'System Synchronizer',
                'created_at' => $randomDate,
                'updated_at' => $randomDate
            ]);
            $createdCount++;
        }
    }

    // Sync Downloads
    $existingDownloads = Log::where('action', 'download')
        ->where('model_type', Document::class)
        ->where('model_id', $doc->id)
        ->count();
    
    $neededDownloads = $doc->download_count - $existingDownloads;
    
    if ($neededDownloads > 0) {
        for ($i = 0; $i < $neededDownloads; $i++) {
            $randomDate = Carbon::now()->subDays(rand(0, 25))->subHours(rand(0, 23));
            
            Log::create([
                'action' => 'download',
                'model_type' => Document::class,
                'model_id' => $doc->id,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'System Synchronizer',
                'created_at' => $randomDate,
                'updated_at' => $randomDate
            ]);
            $createdCount++;
        }
    }
}

echo "Created $createdCount log entries to match existing document statistics.\n";
