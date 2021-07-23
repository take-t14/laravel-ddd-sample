<?php
namespace Packages\DDDEcSample\UseCase\Cart\CartAdd;

use Illuminate\Http\JsonResponse;

/**
 * class ICartAddUseCase
 * 
 */
interface ICartAddUseCase
{
  /**
   * 
   *
   * @param CartAddInputData inputData 

   * @return JsonResponse
   * @abstract
   * @access public
   */
  public function handle(CartAddInputData $inputData) : JsonResponse;
}