<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Controllers\Api;

use App\Http\Controllers\Controller;
use Packages\DDDEcSample\UseCase\Order\OrderCheck\IOrderCheckUseCase;
use Packages\DDDEcSample\UseCase\Order\OrderCheck\OrderCheckInputData;
use Packages\DDDEcSample\UseCase\Order\OrderSave\IOrderSaveUseCase;
use Packages\DDDEcSample\UseCase\Order\OrderSave\OrderSaveInputData;

class OrderController extends Controller
{
    public function check(IOrderCheckUseCase $OrderCheckUseCase) {
        $json = $OrderCheckUseCase->handle(
            new OrderCheckInputData(
              isset(request()->last_name) ? request()->last_name : ""
            , isset(request()->first_name) ? request()->first_name : ""
            , isset(request()->mail) ? request()->mail : ""
            , isset(request()->tel) ? request()->tel : ""
            , isset(request()->zip) ? request()->zip : ""
            , isset(request()->address1) ? request()->address1 : ""
        ));
        return $json;
    }
    public function save(IOrderSaveUseCase $OrderSaveUseCase) {
        $json = $OrderSaveUseCase->handle(
            new OrderSaveInputData(
              isset(request()->last_name) ? request()->last_name : ""
            , isset(request()->first_name) ? request()->first_name : ""
            , isset(request()->mail) ? request()->mail : ""
            , isset(request()->tel) ? request()->tel : ""
            , isset(request()->zip) ? request()->zip : ""
            , isset(request()->address1) ? request()->address1 : ""
        ));
        return $json;
    }
}
