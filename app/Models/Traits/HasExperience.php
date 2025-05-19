<?php

namespace App\Models\Traits;

trait HasExperience
{
    public function addExperience(int $points, string $reason = null): void
    {
        $oldLevel = $this->level;
        $this->experience_points += $points;
        $this->updateLevel();

        // Si le niveau a changé, déclencher l'événement
        if ($this->level > $oldLevel) {
            event(new \App\Events\UserLevelUp($this, $oldLevel, $this->level));
        }

        // Log l'attribution des points
        activity()
            ->performedOn($this)
            ->withProperties([
                'points' => $points,
                'reason' => $reason,
                'new_total' => $this->experience_points
            ])
            ->log('experience_gained');
    }

    public function updateLevel(): void
    {
        // Formule de calcul du niveau : niveau = sqrt(points / 100)
        $this->level = (int) floor(sqrt($this->experience_points / 100));
        $this->save();
    }

    public function getNextLevelPoints(): int
    {
        $nextLevel = $this->level + 1;
        return ($nextLevel * $nextLevel) * 100;
    }

    public function getLevelProgressPercentage(): int
    {
        $currentLevelPoints = ($this->level * $this->level) * 100;
        $nextLevelPoints = $this->getNextLevelPoints();
        $pointsInCurrentLevel = $this->experience_points - $currentLevelPoints;
        $pointsNeededForNextLevel = $nextLevelPoints - $currentLevelPoints;

        return (int) (($pointsInCurrentLevel / $pointsNeededForNextLevel) * 100);
    }
}
