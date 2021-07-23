<?php
namespace Packages\DDDEcSample\Domain\Model\Common\Price\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\Number;

/**
 * class PriceTotalTaxin
 * 
 */
class PriceTotalTaxin extends Number
{
  function __construct(PriceTaxIn $priceTaxIn, Quantity $quantity) {
    $value = $priceTaxIn->getValue() * $quantity->getValue();
    parent::__construct($value);
  }
}