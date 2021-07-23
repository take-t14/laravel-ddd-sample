<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderCheck;

use Illuminate\Http\JsonResponse;

/**
 * class IOrderCheckUseCase
 * 
 */
interface IOrderCheckUseCase
{
  /**
   * 
   *
   * @param OrderCheckInputData inputData 

   * @return JsonResponse
   * @abstract
   * @access public
   */
  public function handle(OrderCheckInputData $inputData) : JsonResponse;
}