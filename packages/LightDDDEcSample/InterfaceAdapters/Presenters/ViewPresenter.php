<?php
namespace Packages\LightDDDEcSample\InterfaceAdapters\Presenters;

use Illuminate\View\View;
use Packages\LightDDDEcSample\UseCase\Common\Presenters\IViewPresenter;
use Packages\LightDDDEcSample\UseCase\Common\OutputData\OutputData;

/**
 * class ViewPresenter
 * 
 */
class ViewPresenter implements IViewPresenter
{
  /**
   * 
   *
   * @param OutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(OutputData $outputData) : View {
    $viewModel = (new ViewModel($outputData))->getViewModel();
    $viewModel["urlPrefix"] = "lightddd";
    $viewName = $outputData->getInputData()->getViewName();
    return view($viewName, $viewModel);
  }



}