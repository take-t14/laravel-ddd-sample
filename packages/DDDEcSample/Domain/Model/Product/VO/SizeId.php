<?php
namespace Packages\DDDEcSample\Domain\Model\Product\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\PositiveNumber;

/**
 * class SizeId
 * 
 */
class SizeId extends PositiveNumber
{
  function __construct(string $value) {
    parent::__construct($value, "sizeId");
  }
}