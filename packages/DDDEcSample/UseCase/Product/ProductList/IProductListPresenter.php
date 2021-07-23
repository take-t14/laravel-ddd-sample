<?php
namespace Packages\DDDEcSample\UseCase\Product\ProductList;

use Illuminate\View\View;

/**
 * class IProductListPresenter
 * 
 */
interface IProductListPresenter
{
  /**
   * 
   *
   * @param ProductListOutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(ProductListOutputData $outputData) : View;
}