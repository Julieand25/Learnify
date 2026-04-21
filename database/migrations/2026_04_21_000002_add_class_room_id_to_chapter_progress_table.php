<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite doesn't support modifying constraints via ALTER TABLE,
        // so we recreate the table with class_room_id included.
        Schema::drop('chapter_progress');

        Schema::create('chapter_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('class_room_id')->constrained('class_rooms')->cascadeOnDelete();
            $table->string('chapter_slug', 50);
            $table->unsignedTinyInteger('sections_reached')->default(0);
            $table->timestamps();

            $table->unique(['student_id', 'class_room_id', 'chapter_slug']);
        });
    }

    public function down(): void
    {
        Schema::drop('chapter_progress');

        Schema::create('chapter_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->string('chapter_slug', 50);
            $table->unsignedTinyInteger('sections_reached')->default(0);
            $table->timestamps();

            $table->unique(['student_id', 'chapter_slug']);
        });
    }
};
