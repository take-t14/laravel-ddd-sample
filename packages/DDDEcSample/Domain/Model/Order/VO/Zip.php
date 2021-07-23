<?php
namespace Packages\DDDEcSample\Domain\Model\Order\VO;

use Packages\DDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\ValidateException;
use Packages\DDDEcSample\Domain\Model\Common\VO\StringValue;

/**
 * class Zip
 * 
 */
class Zip extends StringValue
{
  function __construct(string $zip) {
    $validateException = new ValidateException("zip");
    if ("" === $zip) {
      $validateException = $validateException->addError("郵便番号を入力して下さい");
    }
    if (!preg_match("/^[0-9]{3}[¥-]?[0-9]{4}$/", $zip)) {
      $validateException = $validateException->addError("郵便番号の記入に誤りがあります");
    }
    $validateException->throwIfErrorExist();
    parent::__construct($zip);
  }
}