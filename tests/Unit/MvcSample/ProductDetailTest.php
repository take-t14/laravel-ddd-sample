<?php

namespace Tests\Unit\MvcSample;

use Tests\Unit\DDDEcSample\ProductDetailTest as DDDProductDetailTest;
use Packages\MvcSample\App\Http\Controllers\ProductController as MvcProductController;

class ProductDetailTest extends DDDProductDetailTest
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductDetailUsecase()
    {
        $request = $this->createRequest("/mvc/product/detail/{productGroupId}"
            , MvcProductController::class, "detail", "product.detail.detail", ["productGroupId" => "1"]);
        \RequestEx::setRequest($request);
        $productController = resolve(MvcProductController::class);
        $view = $productController->detail();
        $this->checkProductDetailView($view);
    }
}
