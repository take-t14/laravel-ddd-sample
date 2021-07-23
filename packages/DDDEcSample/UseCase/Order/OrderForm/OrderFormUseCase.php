<?php
namespace Packages\DDDEcSample\UseCase\Order\OrderForm;

use Illuminate\View\View;
use Packages\DDDEcSample\UseCase\Product\IProductRepository;
use Packages\DDDEcSample\UseCase\Cart\ICartRepository;
use Packages\DDDEcSample\Domain\Model\Cart\Entity\Cart;

/**
 * class OrderFormUseCase
 * 
 */
class OrderFormUseCase implements IOrderFormUseCase
{
  /** @var IOrderFormPresenter */
  private $orderFormPresenter = null;
  /** @var ICartRepository */
  private $cartRepository = null;

  function __construct(IOrderFormPresenter $orderFormPresenter, ICartRepository $cartRepository) {
    $this->orderFormPresenter = $orderFormPresenter;
    $this->cartRepository = $cartRepository;
  }
  /**
   * 
   *
   * @param InputData inputData 

   * @return View
   * @abstract
   * @access public
   */
  public function handle(OrderFormInputData $inputData) : View {
    /** @var Cart */
    $cart = $this->cartRepository->find();
    return $this->orderFormPresenter->output(
      new OrderFormOutputData($inputData, $cart)
    );
  }
}