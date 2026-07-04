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

        // Clear performance caches
        static::saved(function ($event) {
            \Illuminate\Support\Facades\Cache::forget('admin_dashboard_stats');
            \Illuminate\Support\Facades\Cache::forget('frontend_home_data');
            \Illuminate\Support\Facades\Cache::forget('newest_events');
            \Illuminate\Support\Facades\Cache::forget('prominent_events');
        });

        static::deleted(function ($event) {
            \Illuminate\Support\Facades\Cache::forget('admin_dashboard_stats');
            \Illuminate\Support\Facades\Cache::forget('frontend_home_data');
            \Illuminate\Support\Facades\Cache::forget('newest_events');
            \Illuminate\Support\Facades\Cache::forget('prominent_events');
        });
    }

    // ── Accessors ──────────────────────────────────────

    // ── Core Relationships ─────────────────────────────

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function department()
    {
        return $this->belongsTo(Category::class, 'department_id');
    }

    public function departments()
    {
        return $this->belongsToMany(Category::class, 'event_departments', 'event_id', 'department_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ── Media Relationships ────────────────────────────

    public function media()
    {
        return $this->hasMany(EventMedia::class);
    }

    public function bannerImage()
    {
        return $this->hasOne(EventMedia::class)->where('type', 'image')->where('is_banner', true);
    }

    public function galleryImages()
    {
        return $this->hasMany(EventMedia::class)->where('is_banner', false)->where('is_recap', false);
    }

    public function subBannerImage()
    {
        return $this->hasOne(EventMedia::class)->where('type', 'image')->where('is_recap', true);
    }

    public function videos()
    {
        return $this->hasMany(EventMedia::class)->where('type', 'video');
    }



    public function documents()
    {
        return $this->hasMany(EventDocument::class);
    }

    // ── Schedule & Speakers ────────────────────────────

    public function scheduleItems()
    {
        return $this->hasMany(EventSchedule::class)->orderBy('start_time');
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'event_speakers')
                    ->using(EventSpeaker::class)
                    ->withPivot('role');
    }

    public function guests()
    {
        return $this->belongsToMany(Speaker::class, 'event_speakers')
                    ->using(EventSpeaker::class)
                    ->withPivot('role')
                    ->wherePivot('role', 'guest');
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
