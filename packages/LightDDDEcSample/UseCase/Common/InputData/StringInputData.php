<?php
namespace Packages\LightDDDEcSample\UseCase\Common\InputData;

/**
 * class StringInputData
 * 
 */
class StringInputData extends InputDataBase
{
  function __construct(?string $value) {
    if (is_null($value)) {
      $this->value = "";
      return;
    }
    $this->value = $value;
  }
}