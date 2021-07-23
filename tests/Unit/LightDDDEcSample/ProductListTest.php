<?php

namespace Tests\Unit\LightDDDEcSample;

use Packages\LightDDDEcSample\UseCase\Product\ProductList\IProductListUseCase;
use Packages\LightDDDEcSample\UseCase\Product\ProductList\ProductListInputData;
use Tests\Unit\DDDEcSample\ProductListTest as DDDProductListTest;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;

class ProductListTest extends DDDProductListTest
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductListUsecase()
    {
        $productListUseCase = resolve(IProductListUseCase::class);
        $view = $productListUseCase->handle(new InputData([], "product.list.list"));
        $this->checkProductListView($view);
    }
}
