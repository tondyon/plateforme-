<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\HasExperience;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable,
        TwoFactorAuthenticatable, HasExperience, LogsActivity;

      /**
     * Roles constants with their display names
     */
    public const ROLES = [
        'admin'     => 'Administrateur',
        'formateur' => 'Formateur',
        'étudiant'  => 'Étudiant',
        'supervisor' => 'Superviseur'
    ];

      /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'permissions',
        'profile_photo_path'
    ];

      /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

      /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'permissions' => 'array'
    ];

    /**
     * Vérifie si l'utilisateur possède le rôle donné
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }


      /**
     * The accessors to append to the model's array form.
     */
    protected $appends = [
        'profile_photo_url',
        'role_name'
    ];

      /* ======================== */
      /* = SCOPES QUERY BUILDER = */
      /* ======================== */

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeFormateurs($query)
    {
        return $query->where('role', 'formateur');
    }

    public function scopeEtudiants($query)
    {
        return $query->where('role', 'étudiant');
    }

    public function scopeSupervisors($query)
    {
        return $query->where('role', 'supervisor');
    }

      /* ===================== */
      /* = RELATIONS MODÈLES = */
      /* ===================== */

      /**
     * Relation avec les cours (pour étudiants)
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user')
                   ->withPivot('progress')
                   ->withTimestamps();
    }

      /**
     * Relation avec les cours enseignés (pour formateurs)
     */
    public function taughtCourses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

      /**
     * Get all courses created by this user (for formateurs)
     */
    public function createdCourses(): HasMany
    {
        return $this->hasMany(Course::class, 'formateur_id');
    }

      /**
     * Get all courses the user is enrolled in (for students)
     */
    public function enrolledCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)
            ->withPivot([
                'enrolled_at',
                'completed_at',
                'valid_until',
                'progress'
            ])
            ->withTimestamps();
    }

      /**
     * Relation avec les badges
     */
    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
                    ->withPivot('awarded_at', 'achievement_data')
                    ->withTimestamps();
    }

      /* ================== */
      /* = MÉTHODES RÔLES = */
      /* ================== */

    public function isAdmin(): bool
    {
        return $this->is_admin || $this->email === 'tonde@gmail.com';
    }

    public function isFormateur(): bool
    {
        return $this->role === 'formateur';
    }

    public function isEtudiant(): bool
    {
        return $this->role === 'étudiant';
    }

    public function isSupervisor(): bool
    {
        return $this->role === 'supervisor';
    }

    public function assignRole(string $role): void
    {
        if (!array_key_exists($role, self::ROLES)) {
            throw new \InvalidArgumentException("Le rôle spécifié n'existe pas");
        }

        $this->update(['role' => $role]);
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions[$permission] ?? false;
    }

    /* ======================== */
    /* = ATTRIBUTS PERSONNELS = */
    /* ======================== */

    /**
     * Get the human-readable role name
     */
    public function getRoleNameAttribute(): string
    {
        return self::ROLES[$this->role] ?? 'Inconnu';
    }

    /**
     * Check if user has any of given roles
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    /**
     * Get the courses that are currently valid
     */
    public function validCourses(): BelongsToMany
    {
        return $this->enrolledCourses()
            ->where(function ($query) {
                $query->whereNull('course_user.valid_until')
                    ->orWhere('course_user.valid_until', '>', now());
            });
    }

    /* ====================== */
    /* = FONCTIONS MÉTIERS = */
    /* ====================== */

    /**
     * Enroll user in a course with optional validity period
     */
    public function enrollInCourse(Course $course, ?int $validityDays = null): void
    {
        $this->enrolledCourses()->attach($course, [
            'enrolled_at' => now(),
            'valid_until' => $validityDays ? now()->addDays($validityDays) : null
        ]);
    }

    /**
     * Complete a course
     */
    public function completeCourse(Course $course): void
    {
        $this->enrolledCourses()->updateExistingPivot($course, [
            'completed_at' => now(),
            'progress' => 100
        ]);
    }

    /**
     * Get course progress percentage
     */
    public function courseProgress(Course $course): int
    {
        return $this->enrolledCourses()
            ->where('course_id', $course->id)
            ->first()
            ->pivot
            ->progress ?? 0;
    }

    /**
     * Get total points from all badges
     */
    public function getBadgePoints(): int
    {
        return $this->badges->sum('points_value');
    }

    /**
     * Check for new badges based on user progress
     */
    public function checkForNewBadges(): void
    {
        $unearned_badges = Badge::whereNotIn('id', $this->badges->pluck('id'))->get();

        foreach ($unearned_badges as $badge) {
            if ($badge->checkCriteria($this)) {
                $badge->awardTo($this);
            }
        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['experience_points', 'level'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

}
