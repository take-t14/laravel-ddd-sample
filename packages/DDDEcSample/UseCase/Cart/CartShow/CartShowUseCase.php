<?php
namespace Packages\DDDEcSample\UseCase\Cart\CartShow;

use Illuminate\View\View;
use Packages\DDDEcSample\UseCase\Product\IProductRepository;
use Packages\DDDEcSample\UseCase\Cart\ICartRepository;
use Packages\DDDEcSample\Domain\Model\Cart\Entity\Cart;

/**
 * class CartShowUseCase
 * 
 */
class CartShowUseCase implements ICartShowUseCase
{
  /** @var ICartShowPresenter */
  private $cartShowPresenter = null;
  /** @var ICartRepository */
  private $cartRepository = null;

  function __construct(ICartShowPresenter $cartShowPresenter, ICartRepository $cartRepository) {
    $this->cartShowPresenter = $cartShowPresenter;
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
  public function handle(CartShowInputData $inputData) : View {
    /** @var Cart */
    $cart = $this->cartRepository->find();
    return $this->cartShowPresenter->output(
      new CartShowOutputData($inputData, $cart)
    );
  }
}