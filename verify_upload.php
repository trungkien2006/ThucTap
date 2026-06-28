<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;

// 1. Upload a file using Laravel Storage
$filename = 'test_laravel_upload_' . time() . '.txt';
Storage::disk('google')->put($filename, 'This is a test upload via Laravel Storage facade');
echo "Uploaded: $filename\n";

// 2. Search for the file via Google API to verify its parent folder
$client = new \Google\Client();
$client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
$client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
$client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

$service = new \Google\Service\Drive($client);
$results = $service->files->listFiles([
    'q' => "name='$filename'",
    'fields' => 'files(id, name, parents)'
]);

if (count($results->getFiles()) > 0) {
    $file = $results->getFiles()[0];
    echo "Found on Google Drive! ID: " . $file->getId() . "\n";
    echo "Parent Folders: " . implode(', ', $file->getParents() ?? []) . "\n";
    $expectedFolder = env('GOOGLE_DRIVE_FOLDER');
    echo "Expected UNIEVENTS Folder ID: $expectedFolder\n";
    if (in_array($expectedFolder, $file->getParents() ?? [])) {
        echo "SUCCESS! The file is inside the correct UNIEVENTS folder!\n";
    } else {
        echo "FAIL! The file is NOT in the expected folder.\n";
    }
} else {
    echo "FAIL! File not found on Google Drive.\n";
}
