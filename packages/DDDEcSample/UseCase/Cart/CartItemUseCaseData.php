<?php
namespace Packages\DDDEcSample\UseCase\Cart;

use Packages\DDDEcSample\Domain\Model\Cart\Entity\CartItem;
use Packages\DDDEcSample\UseCase\Product\ProductUseCaseData;
use Packages\DDDEcSample\UseCase\Common\{IntegerUseCaseData, StringUseCaseData};

/**
 * class CartItemUseCaseData
 * 
 */
class CartItemUseCaseData
{
  private $cartId = null;
  /** @var ProductUseCaseData */
  private $product = null;
  private $quantity = null;
  private $taxRate = null;
  private $price = null;
  private $priceTotal = null;
  private $priceTaxIn = null;
  private $priceTotalTaxin = null;
  function __construct(CartItem $cartItem) {
    $this->cartId = new IntegerUseCaseData($cartItem->getCartId()->getValue());
    $this->product = new ProductUseCaseData($cartItem->getProduct());
    $this->quantity = new IntegerUseCaseData($cartItem->getQuantity()->getValue());
    $this->taxRate = new IntegerUseCaseData($cartItem->getTaxRate()->getValue());
    $this->price = new IntegerUseCaseData($cartItem->getPrice()->getValue());
    $this->priceTotal = new IntegerUseCaseData($cartItem->getPriceTotal()->getValue());
    $this->priceTaxIn = new IntegerUseCaseData($cartItem->getPriceTaxIn()->getValue());
    $this->priceTotalTaxin = new IntegerUseCaseData($cartItem->getPriceTotalTaxin()->getValue());
  }
  public function getCartId() : IntegerUseCaseData {
    return $this->cartId;
  }
  public function getProduct() : ProductUseCaseData {
    return $this->product;
  }
  public function getQuantity() : IntegerUseCaseData {
    return $this->quantity;
  }
  public function getTaxRate() : IntegerUseCaseData {
    return $this->taxRate;
  }
  public function getPrice() : IntegerUseCaseData {
    return $this->price;
  }
  public function getPriceTotal() : IntegerUseCaseData {
    return $this->priceTotal;
  }
  public function getPriceTaxIn() : IntegerUseCaseData {
    return $this->priceTaxIn;
  }
  public function getPriceTotalTaxin() : IntegerUseCaseData {
    return $this->priceTotalTaxin;
  }
}