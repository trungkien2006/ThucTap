<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationCheckin extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'checked_in_at' => 'datetime',
        ];
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
