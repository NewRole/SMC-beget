<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    protected $fillable = [
        'table_name',
        'place',
        'name',
        'tkm',
        'games_played',
        'wins',
        'losses',
        'win_rate'
    ];

    protected $casts = [
        'tkm' => 'float',
        'win_rate' => 'float'
    ];
}
