<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
      /**
     * Run the database seeds.
     */
    public function run()
    {
          // 1. Créer toutes les permissions existantes
        $permissions = [
            'create-users',
            'edit-users',
            'delete-users',
            'view-users',
              // Ajoutez ici toutes vos permissions spécifiques
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Créer le rôle admin avec toutes les permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        // 3. Créer l'utilisateur admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'tondehonore88@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Admin123!'),
            'is_admin' => true,
        ]);

        // 4. Assigner le rôle admin à l'utilisateur
        $admin->assignRole('admin');

        $this->command->info('Admin user created with all permissions successfully!');
    }
}
