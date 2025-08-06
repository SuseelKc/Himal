<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Multimedia;
use Illuminate\Support\Facades\Storage;

echo "Testing image URLs...\n";

$records = Multimedia::all();

foreach ($records as $record) {
    echo "\n=== Record ID: {$record->id} ===\n";
    echo "Title: {$record->title}\n";
    echo "File Path: {$record->file_path}\n";
    
    // Check if file exists in storage
    $storagePath = str_replace('/storage/', 'public/', $record->file_path);
    $exists = Storage::exists($storagePath);
    echo "File exists in storage: " . ($exists ? 'YES' : 'NO') . "\n";
    
    // Generate full URL
    $fullUrl = url($record->file_path);
    echo "Full URL: {$fullUrl}\n";
    
    // Check if file is accessible via HTTP
    $headers = @get_headers($fullUrl);
    if ($headers) {
        echo "HTTP Status: " . $headers[0] . "\n";
    } else {
        echo "HTTP Status: Cannot access URL\n";
    }
    
    // Check file size
    if ($exists) {
        $size = Storage::size($storagePath);
        echo "File size: " . number_format($size) . " bytes\n";
    }
    
    echo "---\n";
} 