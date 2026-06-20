<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    // ── Relationships ──────────────────────────────────

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_speakers')
                    ->withPivot('role');
    }

    public function scheduleItems()
    {
        return $this->hasMany(EventSchedule::class);
    }
}
