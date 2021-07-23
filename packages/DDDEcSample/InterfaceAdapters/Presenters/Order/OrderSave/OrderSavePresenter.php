<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Order\OrderSave;

use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\ValidationViewData;
use Packages\DDDEcSample\UseCase\Order\OrderSave\IOrderSavePresenter;
use Packages\DDDEcSample\UseCase\Order\OrderSave\OrderSaveOutputData;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartViewData;

/**
 * class OrderSavePresenter
 * 
 */
class OrderSavePresenter implements IOrderSavePresenter
{
  /**
   * 
   *
   * @param OutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(OrderSaveOutputData $outputData) : JsonResponse {
    $OrderSaveViewModel = new OrderSaveViewModel(
      new ValidationViewData($outputData->getValidationUseCaseData())
      , new CartViewData($outputData->getCart()) 
    );
    return response()->json($OrderSaveViewModel);
  }



}