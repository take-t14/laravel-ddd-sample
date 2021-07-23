<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderSave;

use Illuminate\Http\JsonResponse;

/**
 * class IOrderSaveUseCase
 * 
 */
interface IOrderSaveUseCase
{
  /**
   * 
   *
   * @param OrderSaveInputData inputData 

   * @return JsonResponse
   * @abstract
   * @access public
   */
  public function handle(OrderSaveInputData $inputData) : JsonResponse;
}