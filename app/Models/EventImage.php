<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_banner' => 'boolean',
            'created_at' => 'datetime',
        ];
    }

    // ── Relationships ──────────────────────────────────

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // ── Scopes ─────────────────────────────────────────

    public function scopeBanners($query)
    {
        return $query->where('is_banner', true);
    }

    public function scopeGallery($query)
    {
        return $query->where('is_banner', false);
    }
}
