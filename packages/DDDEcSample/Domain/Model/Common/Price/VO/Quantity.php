<?php
namespace Packages\DDDEcSample\Domain\Model\Common\Price\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\Number;

/**
 * class Quantity
 * 
 */
class Quantity extends Number
{
  function __construct(int $value) {
    parent::__construct($value);
  }
}