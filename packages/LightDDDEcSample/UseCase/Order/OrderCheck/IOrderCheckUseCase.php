<?php
namespace Packages\LightDDDEcSample\UseCase\Order\OrderCheck;

use Illuminate\Http\JsonResponse;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;

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
  public function handle(InputData $inputData) : JsonResponse;
}