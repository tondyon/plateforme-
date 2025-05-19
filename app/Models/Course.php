<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\CourseMaterial;
use App\Models\Schedule;

class Course extends Model
{
    use HasFactory;
    //
    
    protected $fillable = [
        'title', 'description', 'image', 'teacher_id', 'is_active'
    ];
    
    /**
     * Relation avec les étudiants
     */
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')
                   ->withPivot('progress')
                   ->withTimestamps();
    }
    
    /**
     * Relation avec le formateur
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    
    /**
     * Relation avec les inscriptions
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    
    public function materials()
    {
        return $this->hasMany(CourseMaterial::class);
    }
    
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Relation avec les leçons
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Relation avec les paiements
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Relation avec les feedbacks
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }


    public function generateCertificateCode($userId)
    {
        $enrollment = $this->enrolledStudents()->where('user_id', $userId)->first();
        
        if ($enrollment && $enrollment->pivot->progress == 100) {
            if (!$enrollment->pivot->certificate_verification_code) {
                $code = Str::uuid();
                $enrollment->pivot->certificate_verification_code = $code;
                $enrollment->pivot->save();
                return $code;
            }
            return $enrollment->pivot->certificate_verification_code;
        }
        
        return null;
    }

    public function enrolledStudents()
    {
        return $this->belongsToMany(User::class, 'course_user')
            ->withPivot('progress', 'enrolled_at', 'completed_at', 'certificate_verification_code')
            ->withTimestamps();
    }

    public function completedStudents()
    {
        return $this->enrolledStudents()
            ->wherePivot('progress', 100)
            ->wherePivot('completed_at', '!=', null);
    }
}
