<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Order\OrderCheck;

use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\ValidationViewData;
use Packages\DDDEcSample\UseCase\Order\OrderCheck\IOrderCheckPresenter;
use Packages\DDDEcSample\UseCase\Order\OrderCheck\OrderCheckOutputData;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartViewData;

/**
 * class OrderCheckPresenter
 * 
 */
class OrderCheckPresenter implements IOrderCheckPresenter
{
  /**
   * 
   *
   * @param OutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(OrderCheckOutputData $outputData) : JsonResponse {
    $orderCheckViewModel = new OrderCheckViewModel(
      new ValidationViewData($outputData->getValidationUseCaseData())
      , new CartViewData($outputData->getCart()) 
    );
    return response()->json($orderCheckViewModel);
  }



}