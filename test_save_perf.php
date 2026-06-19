<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::create(
        '/admin/events/1/save-design',
        'POST',
        [],
        [],
        [],
        ['HTTP_ACCEPT' => 'application/json', 'CONTENT_TYPE' => 'application/json'],
        json_encode([
            'title' => 'Test Event',
            'description' => 'Test Description',
            'schedule_text' => "08:00 - Bắt đầu\n09:00 - Kết thúc",
            'media_slots' => [
                ['url' => '/storage/test.jpg', 'caption' => 'Test']
            ]
        ])
    )
);

echo "Response Status: " . $response->getStatusCode() . "\n";
echo "Response Content: " . $response->getContent() . "\n";
