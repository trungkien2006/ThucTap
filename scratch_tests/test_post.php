<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$event = App\Models\Event::with('departments')->first();
echo "Before POST:\n";
foreach($event->departments as $d) echo "- " . $d->name . "\n";

// simulate the POST request logic.
$request = new \Illuminate\Http\Request();
// If the checkboxes were checked, the POST payload would have department_ids => ['1', '2', ...]
// Let's assume the browser submits what is rendered.
// What is rendered?
$rendered_ids = [];
foreach(App\Models\Category::departments()->get() as $dept) {
    if ($event->departments->contains($dept->id)) {
        $rendered_ids[] = (string)$dept->id;
    }
}
echo "Rendered IDs (what browser would submit): " . implode(',', $rendered_ids) . "\n";

// if browser submits it, it will look like this:
$request->merge(['department_ids' => $rendered_ids]);

// EventController@update logic:
$event->departments()->sync($request->input('department_ids', []));

$event->load('departments');
echo "After POST:\n";
foreach($event->departments as $d) echo "- " . $d->name . "\n";
