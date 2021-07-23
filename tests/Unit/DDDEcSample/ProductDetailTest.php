<?php

namespace Tests\Unit\DDDEcSample;

use Tests\TestCase;
use Packages\DDDEcSample\UseCase\Product\ProductDetail\IProductDetailUseCase;
use Packages\DDDEcSample\UseCase\Product\ProductDetail\ProductDetailInputData;
use Packages\DDDEcSample\Presentation\Product\ProductDetail\ProductDetailViewModel;
use Packages\DDDEcSample\Presentation\Product\{ProductGroupViewData};

class ProductDetailTest extends ProducTestBase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductDetailUsecase()
    {
        $_obIProductDetailUseCase = resolve(IProductDetailUseCase::class);
        $view = $_obIProductDetailUseCase->handle(new ProductDetailInputData("product.detail.detail", "1"));
        $this->checkProductDetailView($view);
    }
    protected function checkProductDetailView($view) {
        $this->assertTrue(!is_null($view));
        $data = $view->getData();
        $this->assertTrue(!is_null($data));
        $this->assertTrue(is_array($data));
        $this->assertTrue(0 < count($data));
        $this->assertTrue(isset($data["viewModel"]));
        /** @var array $viewModel */
        $viewModel = $data["viewModel"];
        $this->assertTrue(!is_null($viewModel["productGroup"]));
        /** @var array $productGroup */
        $productGroup = $viewModel["productGroup"];
        $this->checkProductGroup($productGroup);

        $this->assertTrue(!is_null($viewModel["reviews"]));
        foreach($viewModel["reviews"] as $review) {
            $this->assertTrue(!is_null($review["reviewId"]["value"]));
            $this->assertTrue(!is_null($review["initial"]["value"]));
            $this->assertTrue("" !== $review["initial"]["value"]);
            $this->assertTrue(!is_null($review["reviewPoint"]["value"]));
            $this->assertTrue(!is_null($review["comment"]["value"]));
            $this->assertTrue("" !== $review["comment"]["value"]);
            $this->assertTrue(!is_null($review["insDate"]["value"]));
            $this->assertTrue("" !== $review["insDate"]["value"]);
        }
    }
}
