<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Common;

use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class StringViewData
 * 
 */
class StringViewData implements Arrayable
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