<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDocument extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    // ── Relationships ──────────────────────────────────

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
