<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FormateurAccountSeeder extends Seeder
{
    public function run()
    {
        $formateur = User::create([
            'name' => 'Formateur Test',
            'email' => 'formateur@plateforme.test',
            'password' => Hash::make('Formateur2025!'),
            'role' => 'formateur',
            'email_verified_at' => now(),
        ]);

        $formateur = User::create([
            'name'              => 'Formateur Honore',
            'email'             => 'honoretonde96@gmail.com',
            'password'          => Hash::make('Formateur2025!'),
            'role'              => 'formateur',
            'email_verified_at' => now(),
        ]);
        $formateur->assignRole('formateur');
        // S'assurer que le formateur a la permission d'accéder au dashboard formateur
        // (si vous utilisez Spatie, le middleware 'can:formateur' vérifie le rôle)
        // Rien à ajouter ici si le rôle 'formateur' est bien configuré dans les gates/policies

        $this->command->info('Compte formateur créé.');
    }
}
