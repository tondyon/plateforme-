<?php

namespace App\Events;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CourseCompleted
{
    use Dispatchable, SerializesModels;

    public $course;
    public $user;

    public function __construct(Course $course, User $user)
    {
        $this->course = $course;
        $this->user = $user;
    }
}