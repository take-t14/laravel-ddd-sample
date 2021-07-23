<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Order\OrderForm;

use Packages\DDDEcSample\UseCase\Order\OrderForm\IOrderFormPresenter;
use Packages\DDDEcSample\UseCase\Order\OrderForm\OrderFormOutputData;
use Illuminate\View\View;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartViewData;

/**
 * class OrderFormPresenter
 * 
 */
class OrderFormPresenter implements IOrderFormPresenter
{
  /**
   * 
   *
   * @param OutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(OrderFormOutputData $outputData) : View {
    $viewModel = (new OrderFormViewModel(
      new CartViewData($outputData->getCart())
    ))->toArray();
    $viewName = $outputData->getOrderFormInputData()->getViewName();
    $urlPrefix = "ddd";
    return view($viewName, compact("viewModel", "urlPrefix"));
  }



}