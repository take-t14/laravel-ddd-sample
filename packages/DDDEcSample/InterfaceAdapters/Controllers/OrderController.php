<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Controllers;

use Packages\DDDEcSample\UseCase\Order\OrderForm\IOrderFormUseCase;
use Packages\DDDEcSample\UseCase\Order\OrderForm\OrderFormInputData;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function form(IOrderFormUseCase $OrderFormUseCase) {
        $_objView = $OrderFormUseCase->handle(
            new OrderFormInputData(\Request::route()->getName()));
        return $_objView;
    }
}
