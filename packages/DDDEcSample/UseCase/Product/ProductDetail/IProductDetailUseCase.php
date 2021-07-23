<?php
namespace Packages\DDDEcSample\UseCase\Product\ProductDetail;

use Illuminate\View\View;

/**
 * class IProductDetailUseCase
 * 
 */
interface IProductDetailUseCase
{
  /**
   * 
   *
   * @param ProductDetailInputData inputData 

   * @return View
   * @abstract
   * @access public
   */
  public function handle(ProductDetailInputData $inputData) : View;
}