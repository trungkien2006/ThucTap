<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Let's create an event and assign it a department
$event = App\Models\Event::first();
if (!$event) die("No event found\n");
$dept = App\Models\Category::departments()->first();
$event->departments()->sync([$dept->id]);
echo "Event departments count: " . $event->departments()->count() . "\n";

// Let's instantiate the controller
$controller = app()->make(\App\Http\Controllers\Admin\EventController::class);

$request = \Illuminate\Http\Request::create('/admin/events/' . $event->id . '/design', 'POST', [
    'title' => $event->title,
    'description' => $event->description,
    'title_font_size' => '24',
    // NO department_id in request!
]);

// bypass auth
$app['auth']->loginUsingId(\App\Models\User::first()->id);

$response = $controller->saveDesign($request, $event);

$event->refresh();
echo "Event departments count after saveDesign: " . $event->departments()->count() . "\n";
