<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // ── Relationships ──────────────────────────────────

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'category_id');
    }

    public function departmentEvents()
    {
        return $this->belongsToMany(Event::class, 'event_departments', 'department_id', 'event_id');
    }

    // ── Scopes ─────────────────────────────────────────

    public function scopeEventTypes($query)
    {
        return $query->where('type', 'event_type');
    }

    public function scopeDepartments($query)
    {
        return $query->where('type', 'department');
    }

    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }
}
