<?php

namespace Packages\DDDEcSample\Frameworks\Providers;

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
        $this->app->bind(\Packages\DDDEcSample\UseCase\Product\IProductRepository::class
            , \Packages\DDDEcSample\Infrastructure\Product\Eloquent\ProductRepository::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Review\IReviewRepository::class
            , \Packages\DDDEcSample\Infrastructure\Review\Eloquent\ReviewRepository::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Cart\ICartRepository ::class
            , \Packages\DDDEcSample\Infrastructure\Cart\Eloquent\CartRepository::class);
        $this->app->singleton(\Packages\Common\UseCase\Common\ISessionRepository::class
            , \Packages\Common\Infrastructure\Session\Session\SessionRepository::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Order\IOrderRepository ::class
            , \Packages\DDDEcSample\Infrastructure\Order\Eloquent\OrderRepository::class);
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
