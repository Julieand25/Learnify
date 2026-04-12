<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = ['teacher_id', 'name', 'code', 'color'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'class_room_id', 'student_id')
                    ->withTimestamps();
    }

    // CSS class for background image — alternates by id
    public function getBgAttribute(): string
    {
        return $this->id % 2 === 0 ? 'book-bg' : 'computer-bg';
    }

    // CSS class for card color
    public function getColorClassAttribute(): string
    {
        return match($this->color) {
            'green'  => 'bg-green',
            'teal'   => 'bg-teal',
            'navy'   => 'bg-navy',
            'purple' => 'bg-purple',
            default  => 'bg-grey',
        };
    }
}
