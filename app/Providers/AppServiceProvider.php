<?php

namespace App\Providers;

use App\Services\CRMInterface;
use App\Services\SalesforceCrm;
use App\Services\Spreadsheet\GoogleSpreadsheet;
use App\Services\Spreadsheet\SpreadsheetInterface;
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
        if (env('APP_ENV') === 'production') {
            $this->app['url']->forceScheme('https');
        }

        $this->app->instance(CRMInterface::class, new SalesforceCrm());
        $this->app->instance(SpreadsheetInterface::class, new GoogleSpreadsheet());
    }
}
