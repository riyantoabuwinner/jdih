<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Document;

$latest = Document::latest()->first();
if ($latest) {
    echo "ID: " . $latest->id . "\n";
    echo "Title: " . $latest->title . "\n";
    echo "Status in DB: " . $latest->getRawOriginal('status') . "\n";
    echo "Status via Cast: " . (is_object($latest->status) ? get_class($latest->status) . '::' . $latest->status->value : $latest->status) . "\n";
} else {
    echo "No documents found.\n";
}
