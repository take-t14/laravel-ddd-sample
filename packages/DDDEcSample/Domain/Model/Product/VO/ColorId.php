<?php
namespace Packages\DDDEcSample\Domain\Model\Product\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\PositiveNumber;

/**
 * class ColorId
 * 
 */
class ColorId extends PositiveNumber
{
  function __construct(int $value) {
    parent::__construct($value, "colorId");
  }
}