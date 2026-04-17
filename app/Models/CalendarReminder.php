<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarReminder extends Model
{
    protected $fillable = ['user_id', 'date', 'event_name', 'event_details'];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
