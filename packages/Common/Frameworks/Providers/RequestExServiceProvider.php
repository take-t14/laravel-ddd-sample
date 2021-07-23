<?php

namespace Packages\Common\Frameworks\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Common\Frameworks\Libs\RequestEx;

class RequestExServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("RequestEx", RequestEx::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
