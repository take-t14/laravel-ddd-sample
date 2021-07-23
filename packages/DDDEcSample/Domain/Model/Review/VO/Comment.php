<?php
namespace Packages\DDDEcSample\Domain\Model\Review\VO;

use Packages\DDDEcSample\Domain\Model\Common\VO\StringValue;

/**
 * class Comment
 * 
 */
class Comment extends StringValue
{
  function __construct(string $value) {
    parent::__construct($value, "");
  }
}