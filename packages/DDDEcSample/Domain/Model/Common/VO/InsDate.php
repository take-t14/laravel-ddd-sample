<?php
namespace Packages\DDDEcSample\Domain\Model\Common\VO;

/**
 * class InsDate
 * 
 */
class InsDate extends StringValue
{
  function __construct(string $insDate = "") {
    parent::__construct("" !== $insDate ? $insDate : date('Y-m-d H:i:s'), "insDate");
  }
}