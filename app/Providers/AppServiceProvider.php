<?php

namespace App\Providers;

use App\Services\CrmInterface;
use App\Services\CrmFake;
use App\Services\CrmSalesforce;
use App\Services\Spreadsheet\GoogleSpreadsheet;
use App\Services\Spreadsheet\SpreadsheetInterface;
use Illuminate\Support\ServiceProvider;
use Omniphx\Forrest\Providers\Laravel\Facades\Forrest;

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
        if(env('APP_ENV') !== 'testing') {
            $this->app->instance(CrmInterface::class, new CrmSalesforce());
        } else {
            $this->app->instance(CrmInterface::class, new CrmFake());
        }


        $this->app->instance(SpreadsheetInterface::class, new GoogleSpreadsheet());
    }
}
