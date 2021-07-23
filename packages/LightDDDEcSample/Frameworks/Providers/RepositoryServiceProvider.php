<?php

namespace Packages\LightDDDEcSample\Frameworks\Providers;

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
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Product\IProductRepository::class
            , \Packages\LightDDDEcSample\Infrastructure\Product\Eloquent\ProductRepository::class);
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Review\IReviewRepository::class
            , \Packages\LightDDDEcSample\Infrastructure\Review\Eloquent\ReviewRepository::class);
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Cart\ICartRepository ::class
            , \Packages\LightDDDEcSample\Infrastructure\Cart\Eloquent\CartRepository::class);
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Order\IOrderRepository ::class
            , \Packages\LightDDDEcSample\Infrastructure\Order\Eloquent\OrderRepository::class);
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
