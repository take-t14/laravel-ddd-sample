<?php
namespace Packages\LightDDDEcSample\UseCase\Product\ProductDetail;

use Illuminate\View\View;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;

/**
 * class IProductDetailUseCase
 * 
 */
interface IProductDetailUseCase
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