<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Badge extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'points_value',
        'required_points',
        'category'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_badges')
            ->withPivot('awarded_at', 'achievement_data')
            ->withTimestamps();
    }

    public function awardTo(User $user): void
    {
        if (!$this->users->contains($user->id)) {
            $this->users()->attach($user, [
                'awarded_at' => now(),
                'achievement_data' => json_encode(['earned_at' => now()])
            ]);

            // Attribuer de l'expérience pour l'obtention du badge
            $experiencePoints = $this->points_value * 10; // Points d'expérience basés sur la valeur du badge
            $user->addExperience($experiencePoints, "Badge obtenu : {$this->name}");

            event(new \App\Events\BadgeEarned($user, $this));
        }
    }

    public function checkCriteria(User $user): bool
    {
        // Implémentez votre logique de vérification des critères ici
        return true; // À adapter selon vos besoins
    }
}
