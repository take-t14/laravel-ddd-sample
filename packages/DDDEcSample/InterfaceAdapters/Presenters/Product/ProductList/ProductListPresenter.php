<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\ProductList;

use Packages\DDDEcSample\UseCase\Product\ProductList\IProductListPresenter;
use Packages\DDDEcSample\UseCase\Product\ProductList\ProductListOutputData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\{ProductViewData, ProductGroupViewData};
use Illuminate\View\View;

/**
 * class ProductListPresenter
 * 
 */
class ProductListPresenter implements IProductListPresenter
{
  /**
   * 
   *
   * @param OutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(ProductListOutputData $outputData) : View {
    $productGroups = $outputData->getProductGroups()->map(function ($productGroup) {
      return new ProductGroupViewData($productGroup);
    });
    $viewModel = (new ProductListViewModel($productGroups))->toArray();
    $_strViewName = $outputData->getProductListInputData()->getViewName();
    $urlPrefix = "ddd";
    return view($_strViewName, compact("viewModel", "urlPrefix"));
  }



}