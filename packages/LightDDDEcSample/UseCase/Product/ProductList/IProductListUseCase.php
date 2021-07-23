<?php
namespace Packages\LightDDDEcSample\UseCase\Product\ProductList;

use Illuminate\View\View;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;

/**
 * class IProductListUseCase
 * 
 */
interface IProductListUseCase
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