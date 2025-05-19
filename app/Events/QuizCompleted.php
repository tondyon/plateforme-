<?php

namespace App\Events;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuizCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $quiz;
    public $score;

    public function __construct(User $user, Quiz $quiz, int $score)
    {
        $this->user = $user;
        $this->quiz = $quiz;
        $this->score = $score;
    }
}