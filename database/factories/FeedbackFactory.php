<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    protected $model = Feedback::class;

    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'user_id' => User::factory(),
            'note' => $this->faker->numberBetween(1, 5),
            'content' => $this->faker->sentence(8),
            'is_anonymous' => $this->faker->boolean(20),
            'is_validated' => $this->faker->boolean(80),
            'attachment' => null,
            'reply' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
