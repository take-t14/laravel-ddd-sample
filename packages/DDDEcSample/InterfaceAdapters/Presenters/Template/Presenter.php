<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Template;

use Packages\DDDEcSample\UseCase\Template\IPresenter;
use Packages\DDDEcSample\UseCase\Template\OutputData;
use Illuminate\View\View;

/**
 * class Presenter
 * 
 */
class Presenter implements IPresenter
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

  }



}