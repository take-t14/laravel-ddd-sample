<?php
namespace Packages\DDDEcSample\Domain\Model\Common\VO;

use Packages\DDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\ValidateException;

/**
 * class PositiveNumber
 * 
 */
class PositiveNumber extends Number
{
  function __construct(int $value, string $valueName = "PositiveNumber"
  , string $strErrMsg = "0以上の値を入力して下さい") {
    $validateException = new ValidateException($valueName);
    if (0 > $value) {
      $validateException = $validateException->addError($strErrMsg);
    }
    $validateException->throwIfErrorExist();
    parent::__construct($value);
  }
}