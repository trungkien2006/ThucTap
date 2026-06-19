<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMedia extends Model
{
    public $timestamps = false;

    // Explicitly define the table name to match our migration
    protected $table = 'event_medias';

    protected $guarded = [];

    protected $appends = ['document_url', 'action_url', 'document_name'];

    public function getContentAttribute($value)
    {
        $data = json_decode($value, true);
        return is_array($data) && isset($data['text']) ? $data['text'] : $value;
    }

    public function getDocumentUrlAttribute()
    {
        $data = json_decode($this->attributes['content'] ?? '', true);
        return is_array($data) ? ($data['document_url'] ?? null) : null;
    }

    public function getActionUrlAttribute()
    {
        $data = json_decode($this->attributes['content'] ?? '', true);
        return is_array($data) ? ($data['action_url'] ?? null) : null;
    }

    public function getDocumentNameAttribute()
    {
        $data = json_decode($this->attributes['content'] ?? '', true);
        return is_array($data) ? ($data['document_name'] ?? null) : null;
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
