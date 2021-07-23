<?php
namespace Packages\DDDEcSample\UseCase\Common;

use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class IntegerUseCaseData
 * 
 */
class IntegerUseCaseData implements Arrayable
{
  use ViewModelTrait;
  private $value = null;
  function __construct(?int $value) {
    $this->value = $value;
  }
  public function getValue() : ?int {
    return $this->value;
  }
}