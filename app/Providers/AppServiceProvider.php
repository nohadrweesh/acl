<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
         Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\ApplicationLayer\Schools\Interfaces\ISchoolMainService', 'App\ApplicationLayer\Schools\SchoolMainService');


        $this->app->bind('App\DomainModelLayer\Schools\Repositories\ISchoolMainRepository', 'App\Infrastructure\Schools\SchoolMainRepository');
    }
}
