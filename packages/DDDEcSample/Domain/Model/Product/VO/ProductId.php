<?php
namespace Packages\DDDEcSample\Domain\Model\Product\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\PositiveNumber;

/**
 * class ProductId
 * 
 */
class ProductId extends PositiveNumber
{
  function __construct(int $value) {
    parent::__construct($value, "productId");
  }
}