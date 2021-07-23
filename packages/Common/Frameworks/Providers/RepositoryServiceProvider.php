<?php

namespace Packages\Common\Frameworks\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\Packages\Common\UseCase\Common\ISessionRepository::class
            , \Packages\Common\Infrastructure\Session\Session\SessionRepository::class);
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
