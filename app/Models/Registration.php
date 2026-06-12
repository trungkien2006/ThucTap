<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'email_confirmed' => 'boolean',
        ];
    }

    // ── Relationships ──────────────────────────────────

    public function checkins()
    {
        return $this->hasMany(RegistrationCheckin::class);
    }



    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function department()
    {
        return $this->belongsTo(Category::class, 'department_id');
    }
}
