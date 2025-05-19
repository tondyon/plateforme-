<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'user_id' => User::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'status' => 'paid',
            'paid_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
