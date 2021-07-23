<?php
namespace Packages\LightDDDEcSample\Domain\Model\Order\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\ValidateException;
use Packages\LightDDDEcSample\Domain\Model\Common\VO\StringValue;

/**
 * class Tel
 * 
 */
class Tel extends StringValue
{
  function __construct(string $tel) {
    $validateException = new ValidateException("tel");
    if ("" === $tel) {
      $validateException = $validateException->addError("電話番号を入力して下さい");
    }
    if (!preg_match("/^[0-9]{1}[0-9¥-]*[0-9]{1}$/", $tel)) {
      $validateException = $validateException->addError("電話番号の記入に誤りがあります");
    }
    if (11 < strlen(str_replace("-", "", $tel))) {
      $validateException = $validateException->addError("電話番号は数字11桁以内で入力して下さい");
    }
    $validateException->throwIfErrorExist();
    parent::__construct($tel);
  }
}