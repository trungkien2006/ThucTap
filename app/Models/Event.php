<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['title_font_size', 'title_color', 'title_outline_color', 'title_outline_width', 'title_font_family', 'desc_font_size', 'desc_color', 'desc_font_family'];

    protected $parsedDesignSettings = null;

    public function getDesignSetting($key, $default = null)
    {
        if ($this->parsedDesignSettings === null) {
            $media = $this->media()->where('type', 'design_settings')->first();
            $this->parsedDesignSettings = $media && $media->content ? json_decode($media->content, true) : [];
        }
        return $this->parsedDesignSettings[$key] ?? $default;
    }

    public function getTitleFontSizeAttribute() { return $this->getDesignSetting('title_font_size'); }
    public function getTitleColorAttribute() { return $this->getDesignSetting('title_color'); }
    public function getTitleOutlineColorAttribute() { return $this->getDesignSetting('title_outline_color'); }
    public function getTitleOutlineWidthAttribute() { return $this->getDesignSetting('title_outline_width'); }
    public function getTitleFontFamilyAttribute() { return $this->getDesignSetting('title_font_family'); }
    public function getDescFontSizeAttribute() { return $this->getDesignSetting('desc_font_size'); }
    public function getDescColorAttribute() { return $this->getDesignSetting('desc_color'); }
    public function getDescFontFamilyAttribute() { return $this->getDesignSetting('desc_font_family'); }

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
        return $this->hasMany(EventMedia::class)
            ->where('is_banner', false)
            ->where('type', '!=', 'design_settings');
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
