<?php
namespace Packages\DDDEcSample\UseCase\Cart\CartAdd;

use Illuminate\Http\JsonResponse;
use Packages\DDDEcSample\UseCase\Product\IProductRepository;
use Packages\DDDEcSample\UseCase\Cart\ICartRepository;
use Packages\DDDEcSample\Domain\Model\Cart\Entity\{Cart};
use Packages\DDDEcSample\Domain\Model\Product\VO\ProductId;
use Packages\DDDEcSample\Domain\Model\Common\Price\VO\{Quantity};
use Packages\DDDEcSample\Domain\Service\Cart\CartService;

/**
 * class CartAddUseCase
 * 
 */
class CartAddUseCase implements ICartAddUseCase
{
  /** @var ICartAddPresenter */
  private $cartAddPresenter = null;
  /** @var IProductRepository */
  private $productRepository = null;
  /** @var ICartRepository */
  private $cartRepository = null;
  /** @var CartService */
  private $cartService = null;

  function __construct(ICartAddPresenter $cartAddPresenter, ICartRepository $cartRepository
    , IProductRepository $productRepository, CartService $cartService) {
    $this->cartAddPresenter = $cartAddPresenter;
    $this->cartRepository = $cartRepository;
    $this->productRepository = $productRepository;
    $this->cartService = $cartService;
  }
  /**
   * 
   *
   * @param InputData inputData 

   * @return View
   * @abstract
   * @access public
   */
  public function handle(CartAddInputData $inputData) : JsonResponse {
    return \DB::transaction(function() use($inputData) {
      /** @var Cart */
      $cart = $this->cartRepository->find();
      if (is_null($cart)) {
        $cart = $this->cartRepository->newEmptyCart();
      }
      if (!$inputData->getIsAllRemove()) {
        if ($inputData->getIsRemove()) {
          $cart->removeCartItem(new ProductId($inputData->getProductId()), true);
        } else {
          $cartItem = $this->cartService->getCartItem($cart
            , new ProductId($inputData->getProductId())
            , new Quantity($inputData->getQuantity()));
          $cart->addCartItem($cartItem);
        }
      } else {
        $cart->allRemoveItem();
      }
      $cart = $this->cartRepository->save($cart);
      return $this->cartAddPresenter->output(
        new CartAddOutputData($inputData, $cart)
      );
    });
  }
}