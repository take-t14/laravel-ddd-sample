<?php

namespace Packages\LightDDDEcSample\Frameworks\Providers;

use Illuminate\Support\ServiceProvider;

class PresenterServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Common\Presenters\IViewPresenter::class
            , \Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewPresenter::class);
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Common\Presenters\IApiPresenter::class
            , \Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ApiPresenter::class);
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
