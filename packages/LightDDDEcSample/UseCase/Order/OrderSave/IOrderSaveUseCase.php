<?php
namespace Packages\LightDDDEcSample\UseCase\Order\OrderSave;

use Illuminate\Http\JsonResponse;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;

/**
 * class IOrderSaveUseCase
 * 
 */
interface IOrderSaveUseCase
{
  /**
   * 
   *
   * @param InputData inputData 

   * @return JsonResponse
   * @abstract
   * @access public
   */
  public function handle(InputData $inputData) : JsonResponse;
}