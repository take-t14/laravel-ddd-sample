<?php
namespace Packages\DDDEcSample\UseCase\Cart;

use Packages\DDDEcSample\Domain\Model\Cart\Entity\Cart;
use Illuminate\Support\Collection;
use Packages\DDDEcSample\Domain\Model\Cart\Entity\CartItem;
use Packages\DDDEcSample\UseCase\Common\{IntegerUseCaseData, StringUseCaseData};

/**
 * class CartUseCaseData
 * 
 */
class CartUseCaseData
{
  private $cartId = null;
  private $updDate = null;
  private $total = null;
  private $totalTaxin = null;
  /** @var Collection */
  private $items = null;
  function __construct(?Cart $cart) {
    if (!isset($cart)) {
      $this->cartId = new IntegerUseCaseData(null);
      $this->updDate = new StringUseCaseData("");
      $this->total = new IntegerUseCaseData(null);
      $this->totalTaxin = new IntegerUseCaseData(null);
        $this->items = new Collection();
      return;
    }
    $this->cartId = new IntegerUseCaseData($cart->getCartId()->getValue());
    $this->updDate = new StringUseCaseData($cart->getUpdDate()->getValue());
    $this->total = new IntegerUseCaseData($cart->getTotal()->getValue());
    $this->totalTaxin = new IntegerUseCaseData($cart->getTotalTaxin()->getValue());
    $this->items = $cart->getCartItems()->map(function (CartItem $cartItem) {
      return new CartItemUseCaseData($cartItem);
    });
  }
  public function getCartId() : IntegerUseCaseData {
    return $this->cartId;
  }
  public function getUpdDate() : StringUseCaseData {
    return $this->updDate;
  }
  public function getTotal() : IntegerUseCaseData {
    return $this->total;
  }
  public function getTotalTaxin() : IntegerUseCaseData {
    return $this->totalTaxin;
  }
  function getCartItems() : Collection {
    return $this->items;
  }
}