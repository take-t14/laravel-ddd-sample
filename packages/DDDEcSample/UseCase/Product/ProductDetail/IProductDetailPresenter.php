<?php
namespace Packages\DDDEcSample\UseCase\Product\ProductDetail;

use Illuminate\View\View;

/**
 * class IProductDetailPresenter
 * 
 */
interface IProductDetailPresenter
{
  /**
   * 
   *
   * @param ProductDetailOutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(ProductDetailOutputData $outputData) : View;
}