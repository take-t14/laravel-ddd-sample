<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartShow;

use Packages\DDDEcSample\UseCase\Cart\CartShow\ICartShowPresenter;
use Packages\DDDEcSample\UseCase\Cart\CartShow\CartShowOutputData;
use Illuminate\View\View;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartViewData;

/**
 * class CartShowPresenter
 * 
 */
class CartShowPresenter implements ICartShowPresenter
{
  /**
   * 
   *
   * @param OutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(CartShowOutputData $outputData) : View {
    $viewModel = (new CartShowViewModel(
      new CartViewData($outputData->getCart())
    ))->toArray();
    $_strViewName = $outputData->getCartShowInputData()->getViewName();
    $urlPrefix = "ddd";
    return view($_strViewName, compact("viewModel", "urlPrefix"));
  }



}