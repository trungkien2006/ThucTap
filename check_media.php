<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$event = \App\Models\Event::find(8);
if ($event) {
    echo "Event: " . $event->title . "\n";
    $media = \App\Models\EventMedia::where('event_id', $event->id)->get();
    echo "Total media: " . $media->count() . "\n\n";
    foreach ($media as $m) {
        echo "ID: {$m->id} | Type: {$m->type} | Slot: {$m->slot_number} | Caption: {$m->caption} | URL: {$m->url}\n";
    }
}
