<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\Price\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\Price\VO\{Quantity, TaxRate, Price, PriceTotal, PriceTaxIn, PriceTotalTaxin};
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class OrderBaseItem
 * 
 */
class OrderBaseItem implements Arrayable
{
  use ViewModelTrait;
  /** @var Quantity */
  protected $quantity = null;
  /** @var TaxRate */
  protected $taxRate = null;
  /** @var Price */
  protected $price = null;
  /** @var PriceTotal */
  protected $priceTotal = null;
  /** @var PriceTaxIn */
  protected $priceTaxIn = null;
  /** @var PriceTotalTaxin */
  protected $priceTotalTaxin = null;
  function __construct(Quantity $quantity, TaxRate $taxRate, Price $price) {
    $this->quantity = $quantity;
    $this->taxRate = $taxRate;
    $this->price = $price;
    $this->calcPriceTotal();
    $this->calcPriceTaxIn();
    $this->calcPriceTotalTaxIn();
  }
  public function getQuantity() : Quantity {
    return $this->quantity;
  }
  public function getTaxRate() : TaxRate {
    return $this->taxRate;
  }
  public function getPrice() : Price {
    return $this->price;
  }
  public function getPriceTotal() : PriceTotal {
    return $this->priceTotal;
  }
  public function getPriceTaxIn() : PriceTaxIn {
    return $this->priceTaxIn;
  }
  public function getPriceTotalTaxin() : PriceTotalTaxin {
    return $this->priceTotalTaxin;
  }
  private function calcPriceTotal() {
    $this->priceTotal = new PriceTotal($this->price, $this->quantity);
  }
  private function calcPriceTaxIn() {
    $this->priceTaxIn = new PriceTaxIn($this->price, $this->taxRate);
  }
  private function calcPriceTotalTaxIn() {
    $this->priceTotalTaxin = new PriceTotalTaxin($this->priceTaxIn, $this->quantity);
  }
}