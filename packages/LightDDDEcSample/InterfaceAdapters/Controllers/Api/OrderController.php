<?php
namespace Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api;

use App\Http\Controllers\Controller;
use Packages\LightDDDEcSample\UseCase\Order\OrderCheck\IOrderCheckUseCase;
use Packages\LightDDDEcSample\UseCase\Order\OrderSave\IOrderSaveUseCase;
use Packages\LightDDDEcSample\UseCase\Common\InputData\{InputData, StringInputData};

class OrderController extends Controller
{
    public function check(IOrderCheckUseCase $OrderCheckUseCase) {
        $json = $OrderCheckUseCase->handle(
            new InputData([
              "lastName" => new StringInputData(request()->last_name)
            , "firstName" => new StringInputData(request()->first_name)
            , "mail" => new StringInputData(request()->mail)
            , "tel" => new StringInputData(request()->tel)
            , "zip" => new StringInputData(request()->zip)
            , "address1" => new StringInputData(request()->address1)
        ]));
        return $json;
    }
    public function save(IOrderSaveUseCase $OrderSaveUseCase) {
        $json = $OrderSaveUseCase->handle(
            new InputData([
              "lastName" => new StringInputData(request()->last_name)
            , "firstName" => new StringInputData(request()->first_name)
            , "mail" => new StringInputData(request()->mail)
            , "tel" => new StringInputData(request()->tel)
            , "zip" => new StringInputData(request()->zip)
            , "address1" => new StringInputData(request()->address1)
        ]));
        return $json;
    }
}
