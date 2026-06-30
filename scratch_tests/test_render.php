<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// try DB connection with retry
$max_retries = 5;
for ($i=0; $i<$max_retries; $i++) {
    try {
        $event = App\Models\Event::with('departments')->first();
        break;
    } catch (\Exception $e) {
        sleep(1);
    }
}
if (!$event) die("Failed to connect\n");

$dept = App\Models\Category::departments()->first();
$event->departments()->sync([$dept->id]);

$request = \Illuminate\Http\Request::create('/admin/events/' . $event->id . '/edit', 'GET');
$app->instance('request', $request);
$app['auth']->loginUsingId(\App\Models\User::first()->id);

$controller = app()->make(\App\Http\Controllers\Admin\EventController::class);
$view = $controller->edit($event);
$html = $view->render();

$found = false;
$lines = explode("\n", $html);
foreach($lines as $line) {
    if (strpos($line, 'name="department_ids[]"') !== false && strpos($line, 'value="'.$dept->id.'"') !== false) {
        echo "HTML line: " . trim($line) . "\n";
        if (strpos($line, 'checked') !== false) {
            echo "RESULT: It IS checked!\n";
        } else {
            echo "RESULT: It IS NOT checked!\n";
        }
        $found = true;
    }
}
if (!$found) echo "Checkbox not found in HTML\n";
