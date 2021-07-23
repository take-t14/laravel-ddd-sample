<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\ProductDetail;

use Packages\DDDEcSample\UseCase\Product\ProductDetail\IProductDetailPresenter;
use Packages\DDDEcSample\UseCase\Product\ProductDetail\ProductDetailOutputData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\ProductViewData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Review\ReviewViewData;
use Illuminate\View\View;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\ProductGroupViewData;

/**
 * class ProductDetailPresenter
 * 
 */
class ProductDetailPresenter implements IProductDetailPresenter
{
  /**
   * 
   *
   * @param OutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(ProductDetailOutputData $outputData) : View {
    $_objReviews = $outputData->getReviews()->map(function ($_objReviews) {
      return new ReviewViewData($_objReviews);
    });
    $viewModel = (new ProductDetailViewModel(
      new ProductGroupViewData($outputData->getProductGroup()), $_objReviews))->toArray();
    $viewName = $outputData->getProductDetailInputData()->getViewName();
    $urlPrefix = "ddd";
    return view($viewName, compact("viewModel", "urlPrefix"));
  }



}