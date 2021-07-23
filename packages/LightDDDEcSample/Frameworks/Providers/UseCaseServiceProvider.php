<?php

namespace Packages\LightDDDEcSample\Frameworks\Providers;

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
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Product\ProductList\IProductListUseCase::class
            , \Packages\LightDDDEcSample\UseCase\Product\ProductList\ProductListUseCase::class);
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Product\ProductDetail\IProductDetailUseCase::class
            , \Packages\LightDDDEcSample\UseCase\Product\ProductDetail\ProductDetailUseCase::class);
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Cart\CartShow\ICartShowUseCase::class
            , \Packages\LightDDDEcSample\UseCase\Cart\CartShow\CartShowUseCase::class);            
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Cart\CartAdd\ICartAddUseCase::class
            , \Packages\LightDDDEcSample\UseCase\Cart\CartAdd\CartAddUseCase::class);
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Order\OrderForm\IOrderFormUseCase::class
            , \Packages\LightDDDEcSample\UseCase\Order\OrderForm\OrderFormUseCase::class);
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Order\OrderCheck\IOrderCheckUseCase::class
            , \Packages\LightDDDEcSample\UseCase\Order\OrderCheck\OrderCheckUseCase::class);
        $this->app->bind(\Packages\LightDDDEcSample\UseCase\Order\OrderSave\IOrderSaveUseCase::class
            , \Packages\LightDDDEcSample\UseCase\Order\OrderSave\OrderSaveUseCase::class);
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
