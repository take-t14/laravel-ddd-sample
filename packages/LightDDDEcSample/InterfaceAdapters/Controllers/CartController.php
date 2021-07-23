<?php
namespace Packages\LightDDDEcSample\InterfaceAdapters\Controllers;

use App\Http\Controllers\Controller;
use Packages\LightDDDEcSample\UseCase\Cart\CartShow\ICartShowUseCase;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;

class CartController extends Controller
{
    public function list(ICartShowUseCase $cartShowUseCase) {
        $_objView = $cartShowUseCase->handle(
            new InputData([], \Request::route()->getName()));
        return $_objView;
    }
}
