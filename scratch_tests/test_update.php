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

$request = \Illuminate\Http\Request::create('/admin/events/' . $event->id, 'PUT', [
    'title' => $event->title,
    'slug' => $event->slug,
    'description' => $event->description,
    'event_date' => $event->event_date,
    'location' => $event->location,
    'category_id' => $event->category_id,
    'status' => $event->status,
    // Simulate what happens when the form is submitted without touching anything.
    // If the checkboxes were rendered as checked, they WOULD be in the request.
    'department_ids' => [$dept->id],
    'redirect_to' => 'design',
]);

// bypass auth
$app['auth']->loginUsingId(\App\Models\User::first()->id);

$response = $controller->update($request, $event);

$event->refresh();
echo "Event departments count after update: " . $event->departments()->count() . "\n";
