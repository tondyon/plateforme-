<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
      /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();

            // Clés étrangères
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('course_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('lesson_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');

            // Progression
            $table->unsignedSmallInteger('completion_percentage')
                  ->default(0)
                  ->max(100);

            $table->json('completed_lessons')
                  ->nullable()
                  ->default(null);

            // Timestamps
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Métriques
            $table->unsignedInteger('time_spent')->default(0);
            $table->unsignedSmallInteger('last_quiz_score')->nullable();

            // Index
            $table->index(['user_id', 'course_id'], 'progress_user_course_index');
            $table->index(['completion_percentage'], 'progress_completion_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
