<?php
namespace Packages\DDDEcSample\Domain\Model\Order\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\PositiveNumber;

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