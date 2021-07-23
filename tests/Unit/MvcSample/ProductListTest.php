<?php

namespace Tests\Unit\MvcSample;

use Tests\Unit\DDDEcSample\ProductListTest as DDDProductListTest;
use Packages\MvcSample\App\Http\Controllers\ProductController as MvcProductController;

class ProductListTest extends DDDProductListTest
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductListUsecase()
    {
        $request = $this->createRequest("/mvc/product/list", MvcProductController::class, "list", "product.list.list");
        \RequestEx::setRequest($request);
        $productController = resolve(MvcProductController::class);
        $view = $productController->list();
        $this->checkProductListView($view);
    }
}
