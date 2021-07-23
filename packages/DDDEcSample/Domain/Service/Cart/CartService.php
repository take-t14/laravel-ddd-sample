<?php
namespace Packages\DDDEcSample\Domain\Service\Cart;

use Packages\DDDEcSample\UseCase\Product\IProductRepository;
use Packages\DDDEcSample\UseCase\Cart\ICartRepository;
use Packages\DDDEcSample\Domain\Model\Cart\Entity\{Cart, CartItem};
use Packages\DDDEcSample\Domain\Model\Common\Price\VO\{Quantity};
use Packages\DDDEcSample\Domain\Model\Product\Entity\Product;
use Packages\DDDEcSample\Domain\Model\Product\VO\ProductId;
use Packages\DDDEcSample\Domain\Model\Order\VO\ValidateError;

/**
 * class CartService
 * 
 */
class CartService
{
  /** @var IProductRepository */
  private $productRepository = null;
  /** @var ICartRepository */
  private $cartRepository = null;
  function __construct(ICartRepository $cartRepository, IProductRepository $productRepository) {
    $this->cartRepository = $cartRepository;
    $this->productRepository = $productRepository;
  }
  public function getCartItem(Cart $cart, ProductId $productId, Quantity $quantity) : CartItem {
    /** @var Product $product */
    $product = $this->productRepository->findById($productId);
    if (!isset($product)) {
      return response()->json(["message" => "カートへ追加対象の商品が見つかりません"], 404);
    }
    return new CartItem($cart->getCartId(), $product, $quantity);
  }
  public function validateCart(?Cart $cart) : ValidateError {
    $validateError = new ValidateError();
    /** @var Cart */
    $cart = $this->cartRepository->find();
    if (is_null($cart)) {
      return $validateError->addErrors("cart", ["カートが空です"]);
    }
    if (0 >= count($cart->getCartItems())) {
      $validateError = $validateError->addErrors("cart", ["カートが空です"]);
    }
    return $validateError;
  }

}