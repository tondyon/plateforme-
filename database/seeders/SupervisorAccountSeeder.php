<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SupervisorAccountSeeder extends Seeder
{
    public function run()
    {
        $supervisor = User::firstOrCreate(
            ['email' => 'superviseur@plateforme.test'],
            [
                'name' => 'Maitre de Stage',
                'password' => Hash::make('Stage2025!'),
                'is_admin' => false,
                'role' => 'supervisor',
                'email_verified_at' => now(),
                'permissions' => json_encode([
                    'view_courses' => true,
                    'view_statistics' => true,
                    'export_data' => true
                ])
            ]
        );

        $this->command->info('Compte superviseur créé avec des permissions spécifiques');
    }
}