<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Controllers;

use Packages\DDDEcSample\UseCase\Cart\CartShow\ICartShowUseCase;
use Packages\DDDEcSample\UseCase\Cart\CartShow\CartShowInputData;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function list(ICartShowUseCase $cartShowUseCase) {
        $_objView = $cartShowUseCase->handle(
            new CartShowInputData(\Request::route()->getName()));
        return $_objView;
    }
}
