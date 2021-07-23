<?php
namespace Packages\LightDDDEcSample\UseCase\Common\InputData;

/**
 * class BoolInputData
 * 
 */
class BoolInputData extends InputDataBase
{
  function __construct(?string $value) {
    if (is_null($value)) {
      return;
    }
    if ("1" === $value || "true" === strtolower($value)) {
      $this->value = true;
    } else {
      $this->value = false;
    }
  }
}