<?php
namespace Packages\DDDEcSample\Domain\Model\Product\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\PositiveNumber;

/**
 * class ProductGroupId
 * 
 */
class ProductGroupId extends PositiveNumber
{
  function __construct(int $value) {
    parent::__construct($value, "productGroupId");
  }
}