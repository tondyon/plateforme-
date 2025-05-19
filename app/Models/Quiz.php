<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'description',
        'course_id',
        'lesson_id',
        'passing_score',
        'is_mandatory',
        'time_limit'
    ];

    protected $casts = [
        'is_mandatory' => 'boolean',
        'passing_score' => 'integer',
        'time_limit' => 'integer'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function getUserBestScore(User $user): ?int
    {
        return $this->attempts()
            ->where('user_id', $user->id)
            ->max('score');
    }

    public function hasUserPassed(User $user): bool
    {
        $bestScore = $this->getUserBestScore($user);
        return $bestScore !== null && $bestScore >= $this->passing_score;
    }
}
