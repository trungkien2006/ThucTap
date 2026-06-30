<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$event = App\Models\Event::with('departments')->first();
$allDepartments = App\Models\Category::departments()->pluck('id')->toArray();

foreach($event->departments as $dept) {
    if (!in_array($dept->id, $allDepartments)) {
        echo "Found a department attached to event that is NOT in Category::departments(): " . $dept->name . " (type: " . $dept->type . ")\n";
    } else {
        echo "Valid attached department: " . $dept->name . "\n";
    }
}
echo "Done.\n";
