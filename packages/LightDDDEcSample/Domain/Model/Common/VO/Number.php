<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\ValidateException;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class Number
 * 
 */
class Number implements Arrayable
{
  use ViewModelTrait;
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