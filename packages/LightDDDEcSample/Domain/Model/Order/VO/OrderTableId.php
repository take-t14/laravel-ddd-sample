<?php
namespace Packages\LightDDDEcSample\Domain\Model\Order\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\VO\PositiveNumber;

/**
 * class OrderTableId
 * 
 */
class OrderTableId extends PositiveNumber
{
  function __construct(int $value) {
    parent::__construct($value, "orderTableId");
  }
}