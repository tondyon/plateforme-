<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'scheduled_at',
        'start_at',
        'end_at',
        'formateur_id',
        'zoom_link',
        'course_id', // Ajouté pour liaison avec Course
    ];

    public function formateur()
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Vérifie si la réunion est expirée (fin passée)
     */
    public function isExpired(): bool
    {
        return $this->end_at && now()->greaterThan($this->end_at);
    }
}
