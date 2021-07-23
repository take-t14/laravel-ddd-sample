<?php
namespace Packages\DDDEcSample\Domain\Model\Common\Price\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\PositiveNumber;

/**
 * class TaxRate
 * 
 */
class TaxRate extends PositiveNumber
{
  function __construct(int $value) {
    parent::__construct($value, "taxRate");
  }
}