<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$slug = \App\Models\Event::first()->slug;
echo "Testing slug: $slug\n";

$request = Illuminate\Http\Request::create('/events/' . urlencode($slug), 'GET');
$response = $kernel->handle($request);

echo "STATUS: " . $response->getStatusCode() . "\n";
if ($response->getStatusCode() >= 500) {
    if (method_exists($response, 'exception') && $response->exception) {
        echo "EXCEPTION: " . $response->exception->getMessage() . "\n";
    } else {
        echo "EXCEPTION: " . $response->getContent() . "\n";
    }
}
