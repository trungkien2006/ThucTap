<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$event = App\Models\Event::with('departments')->first();
echo "Before: \n";
foreach($event->departments as $dept) {
    echo "- " . $dept->name . "\n";
}

// simulate old('department_ids') check
$old = old('department_ids'); // will be null here
echo "old('department_ids'): " . var_export($old, true) . "\n";

// if old is null, is_array is false, !old is true
$is_checked = (!old('department_ids') && $event->departments->contains($dept->id));
echo "Would be checked: " . ($is_checked ? 'YES' : 'NO') . "\n";
