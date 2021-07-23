<?php
namespace Packages\LightDDDEcSample\Domain\Model\Order\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\ValidateException;
use Packages\LightDDDEcSample\Domain\Model\Common\VO\StringValue;

/**
 * class FirstName
 * 
 */
class FirstName extends StringValue
{
  function __construct(string $firstName) {
    $validateException = new ValidateException("first_name");
    if ("" === $firstName) {
      $validateException = $validateException->addError("名前を入力して下さい");
    }
    if (20 < strlen($firstName)) {
      $validateException = $validateException->addError("名前は20文字以内でご記入ください");
    }
    $validateException->throwIfErrorExist();
    parent::__construct($firstName);
  }
}