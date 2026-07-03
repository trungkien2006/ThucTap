<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventSpeaker extends Pivot
{
    protected $table = 'event_speakers';

    public $incrementing = true;

    public $timestamps = false;
}
