<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart;

use Packages\DDDEcSample\UseCase\Cart\CartUseCaseData;
use Packages\DDDEcSample\UseCase\Cart\CartItemUseCaseData;
use Illuminate\Support\Collection;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\{IntegerViewData, StringViewData};

/**
 * class CartViewData
 * 
 */
class CartViewData implements Arrayable
{
  use ViewModelTrait;
  private $cartId = null;
  private $updDate = null;
  private $total = null;
  private $totalTaxin = null;
  /** @var Collection */
  private $items = null;
  function __construct(CartUseCaseData $cart) {
    $this->cartId = new IntegerViewData($cart->getCartId()->getValue());
    $this->updDate = new StringViewData($cart->getUpdDate()->getValue());
    $this->total = new IntegerViewData($cart->getTotal()->getValue());
    $this->totalTaxin = new IntegerViewData($cart->getTotalTaxin()->getValue());
    $this->items = $cart->getCartItems()->map(function (CartItemUseCaseData $cartItem) {
      return new CartItemViewData($cartItem);
    });
  }
  public function getCartId() : IntegerViewData {
    return $this->cartId;
  }
  public function getUpdDate() : StringViewData {
    return $this->updDate;
  }
  public function getTotal() : IntegerViewData {
    return $this->total;
  }
  public function getTotalTaxin() : IntegerViewData {
    return $this->totalTaxin;
  }
  public function getCartItems() : Collection {
    return $this->items;
  }
}