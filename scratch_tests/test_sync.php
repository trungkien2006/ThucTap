<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$event = App\Models\Event::with('departments')->first();
echo "Before sync: " . $event->departments->count() . " departments\n";

// simulate the $request->input('department_ids', []) when NO checkboxes are checked
$department_ids = []; 

$event->departments()->sync($department_ids);

$event->load('departments');
echo "After sync: " . $event->departments->count() . " departments\n";
