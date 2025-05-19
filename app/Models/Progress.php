<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Progress extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id',
        'completion_percentage',
        'completed_lessons',
        'started_at',
        'completed_at',
        'time_spent',
        'last_quiz_score'
    ];

    protected $casts = [
        'completed_lessons' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function markLessonCompleted(int $lessonId): void
    {
        $completedLessons = $this->completed_lessons ?? [];
        if (!in_array($lessonId, $completedLessons)) {
            $completedLessons[] = $lessonId;
            $this->completed_lessons = $completedLessons;
            $this->updateCompletionPercentage();
            $this->save();
        }
    }

    public function updateCompletionPercentage(): void
    {
        $totalLessons = $this->course->lessons()->count();
        if ($totalLessons > 0) {
            $completedCount = count($this->completed_lessons ?? []);
            $this->completion_percentage = ($completedCount / $totalLessons) * 100;
        }
    }
}
