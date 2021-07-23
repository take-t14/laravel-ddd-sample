<?php
namespace Packages\LightDDDEcSample\Domain\Model\Cart\Entity;

use Packages\LightDDDEcSample\Domain\Model\Cart\VO\{CartId};
use Packages\LightDDDEcSample\Domain\Model\Product\Entity\Product;
use Packages\LightDDDEcSample\Domain\Model\Common\Price\VO\{Quantity, Price, TaxRate, PriceTotal, PriceTaxIn, PriceTotalTaxin, OrderBaseItem};
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class CartItem
 * 
 */
class CartItem extends OrderBaseItem implements Arrayable
{
  use ViewModelTrait;
  /** @var CartId */
  private $cartId = null;
  /** @var Product */
  private $product = null;
  function __construct(?CartId $cartId, Product $product, Quantity $quantity) {
    parent::__construct($quantity, $product->getTaxRate(), $product->getPrice());
    $this->cartId = $cartId;
    $this->product = $product;
  }
  public function getCartId() : CartId {
    return $this->cartId;
  }
  public function getProduct() : Product {
    return $this->product;
  }
  public function addQuantity(Quantity $quantity) {
    $this->quantity = new Quantity($this->quantity->getValue() + $quantity->getValue());
  }
}