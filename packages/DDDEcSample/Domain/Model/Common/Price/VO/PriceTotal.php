<?php
namespace Packages\DDDEcSample\Domain\Model\Common\Price\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\Number;

/**
 * class PriceTotal
 * 
 */
class PriceTotal extends Number
{
  function __construct(Price $price, Quantity $quantity) {
    $value = $price->getValue() * $quantity->getValue();
    parent::__construct($value);
  }
}