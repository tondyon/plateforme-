<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
     public function register()
     {
         $this->app->bind(
             \Illuminate\Auth\Passwords\PasswordBroker::class,
             function ($app) {
                 return $app['auth']->broker();
             }
         );
     }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Réduire la longueur des colonnes string pour éviter l'erreur de clé trop longue
        Schema::defaultStringLength(191);
    }
}
