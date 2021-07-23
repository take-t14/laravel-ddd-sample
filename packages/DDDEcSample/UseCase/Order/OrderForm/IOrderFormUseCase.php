<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderForm;

use Illuminate\View\View;

/**
 * class IOrderFormUseCase
 * 
 */
interface IOrderFormUseCase
{
  /**
   * 
   *
   * @param OrderFormInputData inputData 

   * @return View
   * @abstract
   * @access public
   */
  public function handle(OrderFormInputData $inputData) : View;
}