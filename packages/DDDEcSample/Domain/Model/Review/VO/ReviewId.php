<?php
namespace Packages\DDDEcSample\Domain\Model\Review\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\PositiveNumber;

/**
 * class ReviewId
 * 
 */
class ReviewId extends PositiveNumber
{
  function __construct(int $value) {
    parent::__construct($value, "reviewId");
  }
}