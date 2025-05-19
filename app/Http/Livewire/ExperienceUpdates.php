<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExperienceUpdates extends Component
{
    public $experience;
    public $level;
    public $progress;
    public $showAnimation = false;
    public $gainedExperience = 0;

    public function mount()
    {
        $user = auth()->user();
        $this->experience = $user->experience_points;
        $this->level = $user->level;
        $this->progress = $user->getLevelProgressPercentage();
    }

    public function getListeners()
    {
        return [
            "echo-private:user.".auth()->id().",ExperienceGained" => 'handleExperienceGained',
            "echo-private:user.".auth()->id().",LevelUp" => 'handleLevelUp',
        ];
    }

    public function handleExperienceGained($event)
    {
        $this->gainedExperience = $event['points'];
        $this->showAnimation = true;
        $this->experience = $event['newTotal'];
        $this->progress = $event['newProgress'];
        
        $this->dispatchBrowserEvent('experience-gained', [
            'points' => $this->gainedExperience,
            'reason' => $event['reason']
        ]);
    }

    public function handleLevelUp($event)
    {
        $this->level = $event['newLevel'];
        $this->dispatchBrowserEvent('level-up', [
            'level' => $this->level
        ]);
    }

    public function render()
    {
        return view('livewire.experience-updates');
    }
}