<?php
namespace Packages\LightDDDEcSample\Domain\Model\Order\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\ValidateException;
use Packages\LightDDDEcSample\Domain\Model\Common\VO\StringValue;

/**
 * class LastName
 * 
 */
class LastName extends StringValue
{
  function __construct(string $lastName) {
    $validateException = new ValidateException("last_name");
    if ("" === $lastName) {
      $validateException = $validateException->addError("氏名を入力して下さい");
    }
    if (20 < strlen($lastName)) {
      $validateException = $validateException->addError("氏名は20文字以内でご記入下さい");
    }
    $validateException->throwIfErrorExist();
    parent::__construct($lastName);
  }
}