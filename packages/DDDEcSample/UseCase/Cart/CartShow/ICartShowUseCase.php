<?php
namespace Packages\DDDEcSample\UseCase\Cart\CartShow;

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
   * @param CartShowInputData inputData 

   * @return View
   * @abstract
   * @access public
   */
  public function handle(CartShowInputData $inputData) : View;
}