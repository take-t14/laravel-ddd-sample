<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Cart;

use Packages\DDDEcSample\InterfaceAdapters\Presenters\Product\ProductViewData;
use Packages\DDDEcSample\UseCase\Cart\CartItemUseCaseData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\{IntegerViewData, StringViewData};

/**
 * class CartItemViewData
 * 
 */
class CartItemViewData implements Arrayable
{
  use ViewModelTrait;
  private $cartId = null;
  /** @var ProductViewData */
  private $product = null;
  private $quantity = null;
  private $taxRate = null;
  private $price = null;
  private $priceTotal = null;
  private $priceTaxIn = null;
  private $priceTotalTaxin = null;
  function __construct(CartItemUseCaseData $cartItem) {
    $this->cartId = new IntegerViewData($cartItem->getCartId()->getValue());
    $this->product = new ProductViewData($cartItem->getProduct());
    $this->quantity = new IntegerViewData($cartItem->getQuantity()->getValue());
    $this->taxRate = new IntegerViewData($cartItem->getTaxRate()->getValue());
    $this->price = new IntegerViewData($cartItem->getPrice()->getValue());
    $this->priceTotal = new IntegerViewData($cartItem->getPriceTotal()->getValue());
    $this->priceTaxIn = new IntegerViewData($cartItem->getPriceTaxIn()->getValue());
    $this->priceTotalTaxin = new IntegerViewData($cartItem->getPriceTotalTaxin()->getValue());
  }
  public function getCartId() : IntegerViewData {
    return $this->cartId;
  }
  public function getProduct() : ProductViewData {
    return $this->product;
  }
  public function getQuantity() : IntegerViewData {
    return $this->quantity;
  }
  public function getTaxRate() : IntegerViewData {
    return $this->taxRate;
  }
  public function getPrice() : IntegerViewData {
    return $this->price;
  }
  public function getPriceTotal() : IntegerViewData {
    return $this->priceTotal;
  }
  public function getPriceTaxIn() : IntegerViewData {
    return $this->priceTaxIn;
  }
  public function getPriceTotalTaxin() : IntegerViewData {
    return $this->priceTotalTaxin;
  }
}