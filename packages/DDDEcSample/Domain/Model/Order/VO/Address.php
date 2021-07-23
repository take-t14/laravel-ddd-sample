<?php
namespace Packages\DDDEcSample\Domain\Model\Order\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\StringValue;

/**
 * class Address
 * 
 */
class Address extends StringValue
{
  function __construct(string $value) {
    parent::__construct($value, "address1", "住所を入力して下さい");
  }
}