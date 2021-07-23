<?php
namespace Packages\LightDDDEcSample\UseCase\Cart\CartAdd;

use Illuminate\Http\JsonResponse;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;

/**
 * interface ICartAddUseCase
 * 
 */
interface ICartAddUseCase
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