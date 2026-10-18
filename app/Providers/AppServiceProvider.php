<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Wirft eine Exception, wenn eine Relation "lazy" (nachträglich in einer Schleife)
        // geladen wird. So fallen N+1-Probleme sofort auf. In Produktion ausgeschaltet.
        Model::preventLazyLoading(! app()->isProduction());
    }
}
