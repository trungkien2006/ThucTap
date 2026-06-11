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
            'checked_in' => 'boolean',
            'checked_in_at' => 'datetime',
            'email_confirmed' => 'boolean',
        ];
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
