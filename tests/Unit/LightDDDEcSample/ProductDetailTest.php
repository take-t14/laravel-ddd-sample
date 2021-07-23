<?php

namespace Tests\Unit\LightDDDEcSample;

use Packages\LightDDDEcSample\UseCase\Product\ProductDetail\IProductDetailUseCase;
use Tests\Unit\DDDEcSample\ProductDetailTest as DDDProductDetailTest;
use Packages\LightDDDEcSample\UseCase\Common\InputData\{InputData, IntInputData};

class ProductDetailTest extends DDDProductDetailTest
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductDetailUsecase()
    {
        $_obIProductDetailUseCase = resolve(IProductDetailUseCase::class);
        $productGroupId = new IntInputData("1");
        $view = $_obIProductDetailUseCase->handle(
            new InputData(compact("productGroupId"), "product.detail.detail"));
        $this->checkProductDetailView($view);
    }
}
