<?php
namespace Packages\DDDEcSample\Domain\Model\Common\Price\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\Number;

/**
 * class PriceTaxIn
 * 
 */
class PriceTaxIn extends Number
{
  function __construct(Price $price, TaxRate $taxRate) {
    $value = $price->getValue() + floor($price->getValue() * $taxRate->getValue() / 100);
    parent::__construct($value);
  }
}