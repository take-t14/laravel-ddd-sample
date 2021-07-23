<?php
namespace Packages\DDDEcSample\UseCase\Product\ProductList;

use Illuminate\View\View;

/**
 * class IProductListUseCase
 * 
 */
interface IProductListUseCase
{
  /**
   * 
   *
   * @param ProductListInputData inputData 

   * @return View
   * @abstract
   * @access public
   */
  public function handle(ProductListInputData $inputData) : View;
}