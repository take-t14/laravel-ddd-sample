<?php
namespace Packages\LightDDDEcSample\UseCase\Common\InputData;

/**
 * class IntInputData
 * 
 */
class IntInputData extends InputDataBase
{
  function __construct(?string $value) {
    if (is_null($value)) {
      return;
    }
    if (!preg_match("/^0$|^-?[1-9][0-9]*$/", $value)) {
      return;
    }
    $this->value = (int)$value;
  }
}