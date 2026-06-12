<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'end_date' => 'datetime',
            'registration_open' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });

        static::updating(function ($event) {
            if ($event->isDirty('title') && empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    // ── Accessors ──────────────────────────────────────

    /**
     * Computed status attribute used by views.
     */
    public function getStatusAttribute(): string
    {
        return $this->is_published ? 'published' : 'draft';
    }

    // ── Core Relationships ─────────────────────────────

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function department()
    {
        return $this->belongsTo(Category::class, 'department_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    // ── Media Relationships ────────────────────────────

    public function media()
    {
        return $this->hasMany(EventMedia::class)->orderBy('sort_order');
    }

    public function bannerImage()
    {
        return $this->hasOne(EventMedia::class)->where('type', 'image')->where('is_banner', true);
    }

    public function galleryImages()
    {
        return $this->hasMany(EventMedia::class)->where('type', 'image')->where('is_banner', false)->orderBy('sort_order');
    }

    public function videos()
    {
        return $this->hasMany(EventMedia::class)->where('type', 'video')->orderBy('sort_order');
    }



    public function documents()
    {
        return $this->hasMany(EventDocument::class);
    }

    // ── Schedule & Speakers ────────────────────────────

    public function scheduleItems()
    {
        return $this->hasMany(EventSchedule::class)->orderBy('sort_order');
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'event_speakers')
                    ->using(EventSpeaker::class)
                    ->withPivot('role');
    }



    // ── Scopes ─────────────────────────────────────────

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now());
    }
}
