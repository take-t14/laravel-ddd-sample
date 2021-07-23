<?php
namespace Packages\LightDDDEcSample\UseCase\Order\OrderForm;

use Illuminate\View\View;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;

/**
 * class IOrderFormUseCase
 * 
 */
interface IOrderFormUseCase
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