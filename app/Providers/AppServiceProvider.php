<?php

namespace App\Providers;

use App\Services\CRMInterface;
use App\Services\FakeCRM;
use App\Services\SalesforceCrm;
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
            $this->app->instance(CRMInterface::class, new SalesforceCrm());
        } else {
            $this->app->instance(CRMInterface::class, new FakeCRM());
        }


        $this->app->instance(SpreadsheetInterface::class, new GoogleSpreadsheet());
    }
}
