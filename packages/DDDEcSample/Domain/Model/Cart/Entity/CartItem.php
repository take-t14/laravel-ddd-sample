<?php
namespace Packages\DDDEcSample\Domain\Model\Cart\Entity;

use Packages\DDDEcSample\Domain\Model\Cart\VO\{CartId};
use Packages\DDDEcSample\Domain\Model\Product\Entity\Product;
use Packages\DDDEcSample\Domain\Model\Common\Price\VO\{Quantity, Price, TaxRate, PriceTotal, PriceTaxIn, PriceTotalTaxin, OrderBaseItem};

/**
 * class CartItem
 * 
 */
class CartItem extends OrderBaseItem
{
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