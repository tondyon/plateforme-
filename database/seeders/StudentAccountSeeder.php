<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentAccountSeeder extends Seeder
{
    public function run()
    {
        $student = User::firstOrCreate(
            ['email' => 'honoretonde21@gmail.com'],
            [
                'name' => 'Honore',
                'password' => Hash::make('Etudiant2025!'),
                'role' => 'etudiant',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Compte étudiant créé.');
    }
}
