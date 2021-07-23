<?php
namespace Packages\LightDDDEcSample\InterfaceAdapters\Presenters;

use Illuminate\Http\JsonResponse;
use Packages\LightDDDEcSample\UseCase\Common\Presenters\IApiPresenter;
use Packages\LightDDDEcSample\UseCase\Common\OutputData\OutputData;

/**
 * class ApiPresenter
 * 
 */
class ApiPresenter implements IApiPresenter
{
  /**
   * 
   *
   * @param OutputData outputData 

   * @return JsonResponse
   * @abstract
   * @access public
   */
  public function output(OutputData $outputData) : JsonResponse {
    $viewModel = (new ViewModel($outputData))->getViewModel();
    $viewModel["urlPrefix"] = "lightddd";
    return response()->json($viewModel);
  }



}