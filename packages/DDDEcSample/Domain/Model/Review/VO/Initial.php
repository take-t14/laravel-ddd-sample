<?php
namespace Packages\DDDEcSample\Domain\Model\Review\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\StringValue;

/**
 * class Initial
 * 
 */
class Initial extends StringValue
{
  function __construct(string $value) {
    parent::__construct($value, "");
  }
}