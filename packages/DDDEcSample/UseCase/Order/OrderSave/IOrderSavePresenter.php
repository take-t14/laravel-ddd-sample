<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderSave;

use Illuminate\Http\JsonResponse;

/**
 * class IOrderSavePresenter
 * 
 */
interface IOrderSavePresenter
{
  /**
   * 
   *
   * @param OrderSaveOutputData outputData 

   * @return JsonResponse
   * @abstract
   * @access public
   */
  public function output(OrderSaveOutputData $outputData) : JsonResponse;
}