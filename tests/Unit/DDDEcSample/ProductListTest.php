<?php

namespace Tests\Unit\DDDEcSample;

use Tests\TestCase;
use Packages\DDDEcSample\UseCase\Product\ProductList\IProductListUseCase;
use Packages\DDDEcSample\UseCase\Product\ProductList\ProductListInputData;
use Packages\DDDEcSample\Presentation\Product\{ProductGroupViewData};

class ProductListTest extends ProducTestBase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductListUsecase()
    {
        $productListUseCase = resolve(IProductListUseCase::class);
        $view = $productListUseCase->handle(new ProductListInputData("product.list.list"));
        $this->checkProductListView($view);
    }
    protected function checkProductListView($view) {
        $this->assertTrue(!is_null($view));
        $data = $view->getData();
        $this->assertTrue(!is_null($data));
        $this->assertTrue(is_array($data));
        $this->assertTrue(0 < count($data));
        $this->assertTrue(isset($data["viewModel"]));
        $this->assertTrue(!is_null($data["viewModel"]["productGroups"]));
        foreach($data["viewModel"]["productGroups"] as $productGroup) {
            $this->checkProductGroup($productGroup);
        }
    }
}
