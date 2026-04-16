<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapter_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->string('chapter_slug', 50);
            $table->unsignedTinyInteger('sections_reached')->default(0);
            $table->timestamps();

            $table->unique(['student_id', 'chapter_slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapter_progress');
    }
};
