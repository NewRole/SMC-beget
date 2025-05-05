<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Game extends Model
{
    protected $fillable = [
        'date',
        'time',
        'type',
        'location',
        'max_players'

    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'time' => 'datetime:H:i:s'
    ];

    public function getFullDateTimeAttribute()
    {
        try {
            return Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $this->date->format('Y-m-d').' '.$this->time->format('H:i:s')
            );
        } catch (\Exception $e) {
            return null;
        }
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
