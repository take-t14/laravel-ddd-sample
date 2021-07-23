<?php
namespace Packages\LightDDDEcSample\Domain\Model\Cart\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\VO\PositiveNumber;

/**
 * class CartId
 * 
 */
class CartId extends PositiveNumber
{
  function __construct(int $value) {
    parent::__construct($value, "cartId");
  }
}