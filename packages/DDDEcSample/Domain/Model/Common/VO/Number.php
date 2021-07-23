<?php
namespace Packages\DDDEcSample\Domain\Model\Common\VO;

/**
 * class Number
 * 
 */
class Number
{
  /** @var int */
  protected $value = null;
  function __construct(int $value) {
    $this->value = $value;
  }
  function getValue() : int {
    return $this->value;
  }
  public function equal(Number $other) : bool {
    return $other->getValue() === $this->getValue();
  }
  public function lessThan(Number $other) : bool {
    return $this->getValue() < $other->getValue();
  }
  public function greaterThan(Number $other) : bool {
    return $this->getValue() > $other->getValue();
  }
}