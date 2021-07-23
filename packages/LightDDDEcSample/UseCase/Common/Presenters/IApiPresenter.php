<?php
namespace Packages\LightDDDEcSample\UseCase\Common\Presenters;

use Illuminate\Http\JsonResponse;
use Packages\LightDDDEcSample\UseCase\Common\OutputData\OutputData;

/**
 * class IApiPresenter
 * 
 */
interface IApiPresenter
{
  /**
   * 
   *
   * @param OutputData outputData 

   * @return JsonResponse
   * @abstract
   * @access public
   */
  public function output(OutputData $outputData) : JsonResponse;
}