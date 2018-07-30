<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;;
use App\Observers\UserObserver;
use App\Observers\ManagerObserver;
use App\Observers\AdviserObserver;

use App\User;
use App\Manager;
use App\Adviser;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Manager::observe(ManagerObserver::class);
        Adviser::observe(AdviserObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
