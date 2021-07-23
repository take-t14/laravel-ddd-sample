<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartAdd;

use Packages\DDDEcSample\UseCase\Cart\CartAdd\ICartAddPresenter;
use Packages\DDDEcSample\UseCase\Cart\CartAdd\CartAddOutputData;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart\CartViewData;

/**
 * class CartAddPresenter
 * 
 */
class CartAddPresenter implements ICartAddPresenter
{
  /**
   * 
   *
   * @param OutputData outputData 

   * @return View
   * @abstract
   * @access public
   */
  public function output(CartAddOutputData $outputData) : JsonResponse {
    $viewModel = (new CartAddViewModel(
      new CartViewData($outputData->getCart())
    ))->toArray();
    return response()->json(compact("viewModel"));
  }



}