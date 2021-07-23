<?php
namespace Packages\DDDEcSample\Domain\Model\Product\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\StringValue;

/**
 * class ProductGroupName
 * 
 */
class ProductGroupName extends StringValue
{
  function __construct(string $value) {
    parent::__construct($value, "");
  }
}