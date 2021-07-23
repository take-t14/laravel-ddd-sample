<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderCheck;

use Illuminate\Http\JsonResponse;

/**
 * class IOrderCheckPresenter
 * 
 */
interface IOrderCheckPresenter
{
  /**
   * 
   *
   * @param OrderCheckOutputData outputData 

   * @return JsonResponse
   * @abstract
   * @access public
   */
  public function output(OrderCheckOutputData $outputData) : JsonResponse;
}