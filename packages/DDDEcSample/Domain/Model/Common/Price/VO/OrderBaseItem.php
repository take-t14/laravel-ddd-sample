<?php
namespace Packages\DDDEcSample\Domain\Model\Common\Price\VO;

use Packages\DDDEcSample\Domain\Model\Common\Price\VO\{Quantity, TaxRate, Price, PriceTotal, PriceTaxIn, PriceTotalTaxin};

/**
 * class OrderBaseItem
 * 
 */
class OrderBaseItem
{
  /** @var Quantity */
  protected $quantity = null;
  /** @var TaxRate */
  private $taxRate = null;
  /** @var Price */
  private $price = null;
  /** @var PriceTotal */
  private $priceTotal = null;
  /** @var PriceTaxIn */
  private $priceTaxIn = null;
  /** @var PriceTotalTaxin */
  private $priceTotalTaxin = null;
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