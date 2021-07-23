<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderForm;

use Illuminate\View\View;

/**
 * class IOrderFormPresenter
 * 
 */
interface IOrderFormPresenter
{
  /**
   * 
   *
   * @param CartAddOutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(OrderFormOutputData $outputData) : View;
}