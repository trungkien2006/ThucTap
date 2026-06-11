<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventVideo extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_recap' => 'boolean',
            'created_at' => 'datetime',
        ];
    }

    // ── Relationships ──────────────────────────────────

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
