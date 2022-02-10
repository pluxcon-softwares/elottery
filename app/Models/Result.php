<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'event', 'event_date', 'w1', 'w2', 'w3', 'w4', 'w5', 'wtotal',
        'm1', 'm2', 'm3', 'm4', 'm5', 'mtotal', 'game_id'
    ];

    public function setEventDateAttribute($value)
    {
        $data_string = str_replace('-', '/', $value);
        $this->attributes['event_date'] = date('Y-m-d', strtotime($data_string));
    }

    public function lottery()
    {
        return $this->belongsTo(Lottery::class , 'game_id');
    }
}
