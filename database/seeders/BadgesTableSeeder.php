<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgesTableSeeder extends Seeder
{
    public function run()
    {
        $badges = [
            [
                'name'        => 'Premier Pas',
                'description' => 'A terminé son premier cours',
                'image_path'  => 'badges/first-step.png',
                'type'        => 'achievement',
                'criteria'    => json_encode([
                    'completed_courses_count' => 1
                ]),
                'points_value' => 10,
                'category' => 'achievement'
            ],
            [
                'name' => 'Expert en Formation',
                'description' => 'A terminé 5 cours avec succès',
                'image_path' => 'badges/expert.png',
                'type' => 'achievement',
                'criteria' => json_encode([
                    'completed_courses_count' => 5
                ]),
                'points_value' => 50,
                'category' => 'achievement'
            ],
            [
                'name' => 'Quiz Master',
                'description' => 'A obtenu un score parfait dans un quiz',
                'image_path' => 'badges/quiz-master.png',
                'type' => 'achievement',
                'criteria' => json_encode([
                    'quiz_score' => 100
                ]),
                'points_value' => 30,
                'category' => 'achievement'
            ],
            [
                'name' => 'Apprenant Assidu',
                'description' => 'S\'est connecté 7 jours consécutifs',
                'image_path' => 'badges/regular.png',
                'type' => 'participation',
                'criteria' => json_encode([
                    'consecutive_days' => 7
                ]),
                'points_value' => 20,
                'category' => 'participation'
            ],
            [
                'name' => 'Compétence Développement Web',
                'description' => 'A complété tous les cours de développement web',
                'image_path' => 'badges/web-dev.png',
                'type' => 'skill',
                'criteria' => json_encode([
                    'required_courses' => ['web-basics', 'html-css', 'javascript']
                ]),
                'points_value' => 100,
                'category' => 'skill'
            ]
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
