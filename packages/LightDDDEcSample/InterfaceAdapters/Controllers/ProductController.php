<?php
namespace Packages\LightDDDEcSample\InterfaceAdapters\Controllers;

use App\Http\Controllers\Controller;
use Packages\LightDDDEcSample\UseCase\Product\ProductList\IProductListUseCase;
use Packages\LightDDDEcSample\UseCase\Product\ProductDetail\IProductDetailUseCase;
use Packages\LightDDDEcSample\UseCase\Common\InputData\{InputData, IntInputData};

class ProductController extends Controller
{
    public function list(IProductListUseCase $productListUseCase) {
        $view = $productListUseCase->handle(
            new InputData([], \Request::route()->getName()));
        return $view;
    }
    public function detail(IProductDetailUseCase $productDetailUseCase) {
        $productGroupId = new IntInputData(request()->productGroupId);
        $view = $productDetailUseCase->handle(
            new InputData(compact("productGroupId"), \Request::route()->getName()));
        return $view;
    }
}
