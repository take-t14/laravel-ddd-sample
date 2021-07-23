<?php
namespace Packages\DDDEcSample\UseCase\Template;

use Illuminate\View\View;


/**
 * class IPresenter
 * 
 */
interface IPresenter
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