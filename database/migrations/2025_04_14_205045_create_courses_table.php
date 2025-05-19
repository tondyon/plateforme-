<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            // English column names
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->boolean('is_active')->default(true);
            // Foreign key for teacher
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
