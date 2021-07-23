<?php
namespace Packages\DDDEcSample\UseCase\Cart\CartAdd;

use Illuminate\Http\JsonResponse;

/**
 * class ICartAddPresenter
 * 
 */
interface ICartAddPresenter
{
  /**
   * 
   *
   * @param CartAddOutputData outputData 

   * @return JsonResponse
   * @abstract
   * @access public
   */
  public function output(CartAddOutputData $outputData) : JsonResponse;
}