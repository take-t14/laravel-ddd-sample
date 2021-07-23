<?php
namespace Packages\LightDDDEcSample\Domain\Model\Common\VO;

use Packages\LightDDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\ValidateException;
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class PositiveNumber
 * 
 */
class PositiveNumber extends Number implements Arrayable
{
  use ViewModelTrait;
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