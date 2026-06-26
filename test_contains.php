<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$event = App\Models\Event::with('departments')->first();
if ($event && $event->departments->count() > 0) {
    $dept = $event->departments->first();
    echo "Checking if contains " . $dept->id . ": ";
    var_dump($event->departments->contains($dept->id));
} else {
    echo "No event with departments found.\n";
}
