<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'user_id',
        'game_id',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function game() {
        return $this->belongsTo(Game::class);
    }
}
