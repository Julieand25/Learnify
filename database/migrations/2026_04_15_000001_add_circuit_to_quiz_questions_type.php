<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            // Change from enum to string so 'circuit' is also a valid value.
            // Validation is enforced in the controller, not at DB level.
            $table->string('type', 20)->default('objective')->change();
        });
    }

    public function down(): void
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            $table->enum('type', ['objective', 'subjective'])->default('objective')->change();
        });
    }
};
