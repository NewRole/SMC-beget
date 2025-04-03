<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'date',
        'time',
        'type',
        'location'
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

// Registration.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
