<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function handle(Request $request)
     {
         if ($request->user()) {
             if ($request->user()->isAdmin()) {
                 return redirect()->route('admin.dashboard');  // Rediriger vers le dashboard admin
             }

             if ($request->user()->isFormateur()) {
                 return redirect()->route('formateur.dashboard');  // Rediriger vers le dashboard formateur
             }

             if ($request->user()->isEtudiant()) {
                 return redirect()->route('etudiant.dashboard');  // Rediriger vers le dashboard étudiant
             }
         }

         return $next($request);
     }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
