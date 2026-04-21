<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['student_id', 'class_room_id'];

    protected static function booted(): void
    {
        static::deleted(function (Enrollment $enrollment) {
            NotepadNote::where('student_id', $enrollment->student_id)
                ->where('class_room_id', $enrollment->class_room_id)
                ->delete();

            ChapterProgress::where('student_id', $enrollment->student_id)
                ->where('class_room_id', $enrollment->class_room_id)
                ->delete();

            $quizIds = Quiz::where('class_room_id', $enrollment->class_room_id)
                ->pluck('id');

            QuizAttempt::where('student_id', $enrollment->student_id)
                ->whereIn('quiz_id', $quizIds)
                ->delete();
        });
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
