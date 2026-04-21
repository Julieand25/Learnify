<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notepad_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('class_room_id')->constrained('class_rooms')->cascadeOnDelete();
            $table->string('chapter_slug');
            $table->text('content');
            $table->timestamps();

            $table->unique(['student_id', 'class_room_id', 'chapter_slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notepad_notes');
    }
};
