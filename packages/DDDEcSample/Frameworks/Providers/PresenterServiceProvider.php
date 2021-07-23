<?php

namespace Packages\DDDEcSample\Frameworks\Providers;

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
        $this->app->bind(\Packages\DDDEcSample\UseCase\Product\ProductList\IProductListPresenter::class
            , \Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\ProductList\ProductListPresenter::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Product\ProductDetail\IProductDetailPresenter::class
            , \Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\ProductDetail\ProductDetailPresenter::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Cart\CartShow\ICartShowPresenter::class
            , \Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartShow\CartShowPresenter::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Cart\CartAdd\ICartAddPresenter::class
            , \Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartAdd\CartAddPresenter::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Order\OrderForm\IOrderFormPresenter::class
            , \Packages\DDDEcSample\InterfaceAdapters\Presenters\Order\OrderForm\OrderFormPresenter::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Order\OrderCheck\IOrderCheckPresenter::class
            , \Packages\DDDEcSample\InterfaceAdapters\Presenters\Order\OrderCheck\OrderCheckPresenter::class);
        $this->app->bind(\Packages\DDDEcSample\UseCase\Order\OrderSave\IOrderSavePresenter::class
            , \Packages\DDDEcSample\InterfaceAdapters\Presenters\Order\OrderSave\OrderSavePresenter::class);
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
