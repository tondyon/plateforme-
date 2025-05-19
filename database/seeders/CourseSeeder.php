<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'title' => 'Introduction à Laravel',
            'slug' => 'laravel-intro',
            'description' => 'Découverte du framework PHP Laravel',
            'price' => 49.99,
            'is_published' => true
        ]);

        Course::create([
            'title' => 'Vue.js Avancé',
            'slug' => 'vue-advanced',
            'description' => 'Maîtrise des concepts avancés de Vue.js',
            'price' => 59.99,
            'is_published' => true
        ]);
    }
}
