<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    \Illuminate\Support\Facades\Storage::disk('google')->put('test.txt', 'Hello World from Google Drive API');
    echo "SUCCESS: Uploaded test.txt to Google Drive\n";
    $files = \Illuminate\Support\Facades\Storage::disk('google')->files();
    echo "Files in Drive: \n";
    print_r($files);
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
