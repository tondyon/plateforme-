<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'user_id', 'note', 'content', 'is_anonymous', 'is_validated', 'attachment', 'reply',
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($feedback) {
            if ($feedback->is_validated) {
                $formateur = $feedback->course->teacher;
                if ($formateur) {
                    $formateur->notify(new \App\Notifications\NewFeedbackNotification($feedback));
                }
            }
        });
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
