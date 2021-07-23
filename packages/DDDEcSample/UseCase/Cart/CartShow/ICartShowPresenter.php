<?php
namespace Packages\DDDEcSample\UseCase\Cart\CartShow;

use Illuminate\View\View;

/**
 * class ICartShowPresenter
 * 
 */
interface ICartShowPresenter
{
  /**
   * 
   *
   * @param CartShowOutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(CartShowOutputData $outputData) : View;
}