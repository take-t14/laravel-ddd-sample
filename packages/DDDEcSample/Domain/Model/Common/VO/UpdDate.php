<?php
namespace Packages\DDDEcSample\Domain\Model\Common\VO;

/**
 * class UpdDate
 * 
 */
class UpdDate extends StringValue
{
  function __construct(string $updDate = "") {
    parent::__construct("" !== $updDate ? $updDate : date('Y-m-d H:i:s'), "updDate");
  }
}