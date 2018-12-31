<?php

namespace App\Providers;

use App\Services\CRMInterface;
use App\Services\SalesforceCrm;
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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance(CRMInterface::class, new SalesforceCrm());
    }
}
