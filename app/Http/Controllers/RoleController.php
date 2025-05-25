<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
          // Logique pour lister tous les rôles
        $roles = [
            'analyste-donnees' => 'Analyste de données',
            'gestionnaire-projet' => 'Gestionnaire de projet',
            // Ajoutez d'autres rôles ici
        ];

        return view('roles.index', compact('roles'));
    }

    public function show($role)
    {
        // Logique pour afficher un rôle spécifique
        return view('roles.show', compact('role'));
    }
}
