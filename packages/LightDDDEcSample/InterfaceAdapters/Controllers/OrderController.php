<?php
namespace Packages\LightDDDEcSample\InterfaceAdapters\Controllers;

use App\Http\Controllers\Controller;
use Packages\LightDDDEcSample\UseCase\Order\OrderForm\IOrderFormUseCase;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;

class OrderController extends Controller
{
    public function form(IOrderFormUseCase $OrderFormUseCase) {
        $_objView = $OrderFormUseCase->handle(
            new InputData([], \Request::route()->getName()));
        return $_objView;
    }
}
