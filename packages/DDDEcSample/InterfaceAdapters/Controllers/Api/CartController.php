<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Controllers\Api;

use Packages\DDDEcSample\UseCase\Cart\CartAdd\ICartAddUseCase;
use Packages\DDDEcSample\UseCase\Cart\CartAdd\CartAddInputData;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function add(ICartAddUseCase $cartAddUseCase) {
        $json = $cartAddUseCase->handle(
            new CartAddInputData(
              isset(request()->productId) ? request()->productId : ""
            , isset(request()->quantity) ? request()->quantity : ""
            , isset(request()->isRemove) ? request()->isRemove : ""
            , isset(request()->isAllRemove) ? request()->isAllRemove : ""));
        return $json;
    }
}
