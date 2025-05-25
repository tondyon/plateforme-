<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiplomeFrontController extends Controller
{
    public function index()
    {
          // Par exemple récupérer les diplômes depuis la base :
        // $diplomes = Diplome::all();

        return view('diplomes.index' /*, compact('diplomes')*/);
    }
}
