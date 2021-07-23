<?php

namespace Packages\DDDEcSample\Frameworks\Providers;

use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Packages\DDDEcSample\UseCase\Product\ProductList\IProductListUseCase::class
            , \Packages\DDDEcSample\UseCase\Product\ProductList\ProductListUseCase::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Product\ProductDetail\IProductDetailUseCase::class
            , \Packages\DDDEcSample\UseCase\Product\ProductDetail\ProductDetailUseCase::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Cart\CartShow\ICartShowUseCase::class
            , \Packages\DDDEcSample\UseCase\Cart\CartShow\CartShowUseCase::class);            
        $this->app->bind(\Packages\DDDEcSample\UseCase\Cart\CartAdd\ICartAddUseCase::class
            , \Packages\DDDEcSample\UseCase\Cart\CartAdd\CartAddUseCase::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Order\OrderForm\IOrderFormUseCase::class
            , \Packages\DDDEcSample\UseCase\Order\OrderForm\OrderFormUseCase::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Order\OrderCheck\IOrderCheckUseCase::class
            , \Packages\DDDEcSample\UseCase\Order\OrderCheck\OrderCheckUseCase::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Order\OrderSave\IOrderSaveUseCase::class
            , \Packages\DDDEcSample\UseCase\Order\OrderSave\OrderSaveUseCase::class);
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
