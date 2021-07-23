<?php
namespace Packages\DDDEcSample\UseCase\Template;

use Illuminate\View\View;

/**
 * class IUseCase
 * 
 */
interface IUseCase
{
  /**
   * 
   *
   * @param InputData inputData 

   * @return View
   * @abstract
   * @access public
   */
  public function handle(InputData $inputData) : View;
}