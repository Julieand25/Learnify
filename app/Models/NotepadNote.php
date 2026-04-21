<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotepadNote extends Model
{
    protected $fillable = ['student_id', 'class_room_id', 'chapter_slug', 'content'];
}
