<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Controllers;

use Packages\DDDEcSample\UseCase\Product\ProductList\IProductListUseCase;
use Packages\DDDEcSample\UseCase\Product\ProductList\ProductListInputData;
use Packages\DDDEcSample\UseCase\Product\ProductDetail\IProductDetailUseCase;
use Packages\DDDEcSample\UseCase\Product\ProductDetail\ProductDetailInputData;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function list(IProductListUseCase $productListUseCase) {
        $view = $productListUseCase->handle(
            new ProductListInputData(\Request::route()->getName()));
        return $view;
    }
    public function detail(IProductDetailUseCase $productDetailUseCase) {
        $view = $productDetailUseCase->handle(
            new ProductDetailInputData(\Request::route()->getName(), request()->productGroupId));
        return $view;
    }
}
