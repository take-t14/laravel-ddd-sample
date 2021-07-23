<?php
namespace Packages\DDDEcSample\Domain\Model\Review\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\PositiveNumber;

/**
 * class ReviewPoint
 * 
 */
class ReviewPoint extends PositiveNumber
{
  function __construct(int $value) {
    parent::__construct($value, "reviewPoint");
  }
}