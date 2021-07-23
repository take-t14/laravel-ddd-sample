<?php
namespace Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api;

use App\Http\Controllers\Controller;
use Packages\LightDDDEcSample\UseCase\Cart\CartAdd\ICartAddUseCase;
use Packages\LightDDDEcSample\UseCase\Common\InputData\{InputData, IntInputData, BoolInputData};

class CartController extends Controller
{
    public function add(ICartAddUseCase $cartAddUseCase) {
        $json = $cartAddUseCase->handle(
            new InputData([
              "productId" => new IntInputData(request()->productId)
            , "quantity" => new IntInputData(request()->quantity)
            , "isRemove" => new BoolInputData(request()->isRemove)
            , "isAllRemove" => new BoolInputData(request()->isAllRemove)
            ])
        );
        return $json;
    }
}
