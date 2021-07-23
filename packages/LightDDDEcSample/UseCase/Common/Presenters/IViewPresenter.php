<?php
namespace Packages\LightDDDEcSample\UseCase\Common\Presenters;

use Illuminate\View\View;
use Packages\LightDDDEcSample\UseCase\Common\OutputData\OutputData;

/**
 * class IViewPresenter
 * 
 */
interface IViewPresenter
{
  /**
   * 
   *
   * @param OutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(OutputData $outputData) : View;
}