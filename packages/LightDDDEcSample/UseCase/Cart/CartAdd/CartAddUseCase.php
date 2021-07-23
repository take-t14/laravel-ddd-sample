<?php
namespace Packages\LightDDDEcSample\UseCase\Cart\CartAdd;

use Illuminate\Http\JsonResponse;
use Packages\LightDDDEcSample\UseCase\Product\IProductRepository;
use Packages\LightDDDEcSample\UseCase\Cart\ICartRepository;
use Packages\LightDDDEcSample\Domain\Model\Cart\Entity\{Cart};
use Packages\LightDDDEcSample\Domain\Model\Product\VO\ProductId;
use Packages\LightDDDEcSample\Domain\Model\Common\Price\VO\{Quantity};
use Packages\LightDDDEcSample\Domain\Service\Cart\CartService;
use Packages\LightDDDEcSample\UseCase\Common\InputData\InputData;
use Packages\LightDDDEcSample\UseCase\Common\OutputData\OutputData;
use Packages\LightDDDEcSample\UseCase\Common\Presenters\IApiPresenter;

/**
 * class CartAddUseCase
 * 
 */
class CartAddUseCase implements ICartAddUseCase
{
  /** @var IApiPresenter */
  private $apiPresenter = null;
  /** @var IProductRepository */
  private $productRepository = null;
  /** @var ICartRepository */
  private $cartRepository = null;
  /** @var CartService */
  private $cartService = null;

  function __construct(IApiPresenter $apiPresenter, ICartRepository $cartRepository
    , IProductRepository $productRepository, CartService $cartService) {
    $this->apiPresenter = $apiPresenter;
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
  public function handle(InputData $inputData) : JsonResponse {
    return \DB::transaction(function() use($inputData) {
      /** @var Cart */
      $cart = $this->cartRepository->find();
      if (is_null($cart)) {
        $cart = $this->cartRepository->newEmptyCart();
      }
      if (!$inputData->getValue("isAllRemove")) {
        if ($inputData->getValue("isRemove")) {
          $cart->removeCartItem(new ProductId($inputData->getValue("productId")), true);
        } else {
          $cartItem = $this->cartService->getCartItem($cart
            , new ProductId($inputData->getValue("productId"))
            , new Quantity($inputData->getValue("quantity")));
          $cart->addCartItem($cartItem);
        }
      } else {
        $cart->allRemoveItem();
      }
      $cart = $this->cartRepository->save($cart);
      $viewModel = ["cart" => $cart];
      return $this->apiPresenter->output(
        new OutputData($inputData, compact("viewModel"))
      );
    });
  }
}