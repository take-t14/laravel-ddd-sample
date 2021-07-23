<?php
namespace Packages\DDDEcSample\UseCase\Common;

use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class StringUseCaseData
 * 
 */
class StringUseCaseData implements Arrayable
{
  use ViewModelTrait;
  private $value = "";
  function __construct(string $value) {
    $this->value = $value;
  }
  public function getValue() : string {
    return $this->value;
  }
}