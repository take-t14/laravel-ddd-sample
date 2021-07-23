<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters;

use Illuminate\Contracts\Support\Arrayable;

/**
 * trait ViewModelTrait
 * 
 */
trait ViewModelTrait
{
  function toArray() {
    return $this->toArrayRecursion($this);
  }
  function toArrayRecursion($target) : array {
    $aryObject = [];
    foreach($target as $key => $value) {
      if ($value instanceof Arrayable) {
        $aryObject[$key] = $value->toArray();
      } else if (is_array($value)) {
        $aryObject[$key] = $this->toArrayRecursion($value);
      } else {
        $aryObject[$key] = $value;
      }
    }
    return $aryObject;
  }
}