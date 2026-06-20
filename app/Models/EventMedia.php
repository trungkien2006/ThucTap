<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMedia extends Model
{
    public $timestamps = false;

    // Explicitly define the table name to match our migration
    protected $table = 'event_medias';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->created_at) {
                $model->created_at = now();
            }
        });
    }

    protected function casts(): array
    {
        return [
            'is_banner' => 'boolean',
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
