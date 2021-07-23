<?php

namespace Packages\LightDDDEcSample\Frameworks\Providers;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Order\Notification\IOrderNotification::class
            , \Packages\LightDDDEcSample\Infrastructure\Order\Notification\Mail\OrderNotification::class);
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
