<?php
namespace Packages\LightDDDEcSample\UseCase\Cart\CartShow;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;

use Illuminate\View\View;

/**
 * class ICartShowUseCase
 * 
 */
interface ICartShowUseCase
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