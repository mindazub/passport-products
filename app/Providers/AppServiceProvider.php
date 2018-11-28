<?php

namespace App\Providers;

use App\Facades\PriceConvert;
use App\Helpers\PriceHelper;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot():void 
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerFacades();
    }

    /**
     * @return void
     */

    private function registerFacades(): void
    {
        $this->app->bind('price.convert', function($app){
            return new PriceHelper();
        });
    }

    private function registerAliases(): void
    {
        AliasLoader::getInstance()->alias(PriceConvert::class, PriceHelper::class);
//        AliasLoader::getInstance()->alias('PriceConverter', PriceHelper::class);
    }
}
